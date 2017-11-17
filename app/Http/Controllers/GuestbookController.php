<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use Image;

class GuestbookController extends Controller
{
    public function viewAll(Request $request)
    {
        if ($request->method() === 'POST') {
            $this->validate($request, [
                'username' => 'required|string|regex:/^[a-zA-Z\d]+$/',
                'email' => 'required|string|email',
                'homepage' => 'nullable|string|url',
                'text' => 'string',
//                'captcha' => 'required|captcha',
                'file' => 'nullable|file|mimes:jpg,png,jpeg,gif,txt'
            ],
                [
                    'captcha.captcha' => 'The captcha is incorrect',
                    'username.regex' => 'Use English letters and digits only',
                ]);

            $message = new Message();

            if ($request->hasFile('file')) {
                $file = $request->file('file');

                $extension = $file->guessClientExtension();

                $path = $file->store('message_files');

                if ($extension === 'txt') {
                    $this->validate($request, [
                        'file' => 'max:100'
                    ]);
                } else {
                    $validator = Validator::make($request->all(), [
                        'file' => 'dimensions:max_width=320,max_height=240'
                    ]);

                    if ($validator->fails()) {
                        Image::make('storage/' . $path)->fit(320, 240)->save();
                    }
                }

                $message->path_to_file = Storage::url($path);
            }

            $message->username = $request->get('username');

            $message->email = $request->get('email');

            $message->homepage = $request->get('homepage');

            $message->text = strip_tags($request->get('text'));

            $message->ip = $request->ip();

            $message->browser = get_browser($request->header('User-Agent'))->browser;

            $message->save();
        }

        $messages = Message::sortable(['created_at' => 'desc'])->paginate(25);

        return view('Guestbook.viewAll')->with('messages', $messages);
    }
}