<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Invoice;
use App\Models\Therapist;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Resources\UserResource;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user instanceof (Therapist::class)) return redirect(route('therapist.dashboard', ['therapist' => $user->id]));
        if ($user instanceof (User::class)) {
            // TODO : Redirect public view blade
            // return redirect(route('profile.patient.show', ['patient' => $user->id]));
            abort(404);
        }

        return Inertia::render('Dashboard', [
            'user' => new UserResource($user),
        ]);
    }

    public function getinvoice(Request $request, Invoice  $invoice)
    {
        $pdf = Pdf::loadView('pdf.invoice', ["invoice" => $invoice]);

        return $pdf->stream();
    }
}
