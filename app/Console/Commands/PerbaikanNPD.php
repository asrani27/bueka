<?php

namespace App\Console\Commands;

use App\Models\NpdDetail;
use App\Models\NpdRincian;
use Illuminate\Console\Command;

class PerbaikanNPD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'perbaikannpd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = NpdRincian::get();
        foreach ($data as $item) {
            $check = NpdDetail::find($item->npd_detail_id);
            if ($check === null) {
                $item->npd_detail_id = null;
                $item->save();
            }
        }
    }
}
