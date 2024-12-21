<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // Tentukan lokasi file log CodeIgniter
        $logFilePath = APPPATH . 'logs\log-' . date('Y-m-d') . '.php'; // Sesuaikan dengan format nama file log Anda

        // Baca isi file log
        $logs = $this->readLogs($logFilePath);

        // Kirim data logs ke view
        $data['logs'] = $logs;
        
        // $this->load->view('errors/logs', $data);
    }

    private function readLogs($filePath) {
        $logs = array();

        // Baca file log jika ada
        if (file_exists($filePath)) {
            $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            // Lakukan pemrosesan untuk setiap baris log
            foreach ($lines as $line) {
                // Misalnya, jika format log adalah "[Timestamp] Level: Message", Anda perlu memisahkan data
                // Di sini, kita hanya mengambil bagian pertama sebagai informasi log
                $logs[] = $line;
            }
        }

        return $logs;
    }
}
?>