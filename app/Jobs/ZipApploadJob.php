<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class ZipApploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        //
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // zip ファイルを読み込む
        $zipTmpName = $_FILES['image']['tmp_name'];

        if ($zipTmpName == null) {
            return 0;
        }
        $zipError = $_FILES['image']['error'];

        // zipファイルをオープン
        $zip = zip_open($zipTmpName);
        $entryContentName = array();
        \Log::debug('greagr');
        if (is_resource($zip)) {
            while (($zipEntry = zip_read($zip)) != FALSE) {
                zip_entry_open($zip, $zipEntry, "r");
                $entryName = zip_entry_name($zipEntry);
                $extension = pathinfo($entryName, PATHINFO_EXTENSION); //拡張子取得
                $uniqName = Carbon::now()->format('Ymd') . md5(uniqid(microtime(), 1)) . session_id() . "." . $extension;
                Storage::put('public/image/' . $uniqName, zip_entry_read($zipEntry, zip_entry_filesize($zipEntry)));
                $entryContentName = 'storage/image/' . $uniqName;
            }
            $this->post->image->url = serialize($entryContentName);
            $this->post->save();
        }
        return 0;
    }
}
