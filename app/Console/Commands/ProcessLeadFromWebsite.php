<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Lead;

class ProcessLeadFromWebsite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-lead-from-website';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lead = DB::connection('wordPressMysql')->select("SELECT
        s.id AS submission_id,
        MAX(CASE WHEN sv.key = 'services' THEN sv.value END) AS services,
        MAX(CASE WHEN sv.key = 'name' THEN sv.value END) AS name,
        MAX(CASE WHEN sv.key = 'email' THEN sv.value END) AS email,
        MAX(CASE WHEN sv.key = 'message' THEN sv.value END) AS message
        MAX(CASE WHEN sv.key = 'district' THEN sv.value END) AS district
    FROM
        wp_e_submissions s
    INNER JOIN
        wp_e_submissions_values sv ON s.id = sv.submission_id
        WHERE  s.lead_move='no'
    GROUP BY
        s.id;");
        for ($i=0; $i < count($lead) ; $i++) { 
            DB::connection('wordPressMysql')->table('wp_e_submissions')
        ->where('id', $lead[$i]->submission_id)
        ->update(['lead_move' => 'yes']);

            Lead::create([
                'name' => $lead[$i]->name,
                'email' => $lead[$i]->email,
                'message' => $lead[$i]->message,
                'type_of_service' => $lead[$i]->services,
                'district' => $lead[$i]->district,
            ]);
        }
        $this->info('Processing leads from website...');
    }
}
