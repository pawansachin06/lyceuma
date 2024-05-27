<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class BackupController extends Controller
{
    public function downloadBackup(Request $req)
    {
        $user = $req->user();
        if ($user->isSuperAdmin() || $user->isAdmin()) {
        } else {
            return response()->json([
                'message' => 'Only admins are allowed to take backup',
            ], 422);
        }

        // Database credentials
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST');
        $port = env('DB_PORT');

        // File name and path
        $fileName = 'backup-' . date('Y-m-d_H-i-s') . '.sql';
        $filePath = 'backups'. DIRECTORY_SEPARATOR . $fileName;

        // Command to dump the database
        $command = "mysqldump --host={$host} --port={$port} --user={$username} --password={$password} {$database} > " . storage_path('app'. DIRECTORY_SEPARATOR . 'public'. DIRECTORY_SEPARATOR . $filePath);

        // Execute the command
        $process = Process::fromShellCommandline($command);
        $process->run();

        // Check if the process was successful
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Check if the file was created
        if (file_exists($filePath)) {
            // return response()->download($filePath)->deleteFileAfterSend(true);
            return response()->json([
                'success'=> true,
                'message'=> 'Starting download...',
                'redirect'=> Storage::url($filePath),
            ]);
        }

        return response()->json(['message' => 'Backup failed'], 500);
    }
}
