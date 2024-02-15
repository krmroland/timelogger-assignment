<?php

namespace App\Http\Controllers;

use App\Models\TimeEntry;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportUserTimeEntriesController extends Controller
{
    public function __invoke(User $user, Request $request)
    {
        $request->validate(['date' => 'date']);

        $date = $request->date ? $request->date('date') : null;

        $query = $user->timeEntries()->when($date, fn($q) => $q->whereDate('date', $date));

        $response = new StreamedResponse();

        $response->setCallback(function () use ($query) {
            $out = fopen('php://output', 'w');

            fputcsv($out, TimeEntry::csvHeaders());

            $query->LazyById()->each(fn($entry) => fputcsv($out, $entry->toCsvEntry()));

            fclose($out);
        });

        $response->headers->set('Content-Type', 'text/csv');

        $response->headers->set('Content-Disposition', 'attachment; filename=timelogger.csv;');

        $response->setStatusCode(200);

        return $response;
    }
}
