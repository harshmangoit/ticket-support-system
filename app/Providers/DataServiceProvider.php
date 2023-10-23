<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Models\Ticket;

class DataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function ticketData()
    {
        $user = auth()->user();
        $notAssigned = 0;

        if ($user->role == '3') {
            $totalTickets = Ticket::where('user_id', $user->id)->count();
            $openTickets = Ticket::where('user_id', $user->id)->where('status', 0)->count();
            $closedTickets = Ticket::where('user_id', $user->id)->where('status', 1)->count();
        } else if ($user->role == '2') {
            $totalTickets = Ticket::where('agent_id', $user->id)->count();
            $openTickets = Ticket::where('agent_id', $user->id)->where('status', 0)->count();
            $closedTickets = Ticket::where('agent_id', $user->id)->where('status', 1)->count();
        } else {
            $totalTickets = Ticket::count();
            $openTickets = Ticket::where('status', 0)->count();
            $closedTickets = Ticket::where('status', 1)->count();
            $notAssigned = Ticket::where('agent_id', NULL)->count();
        }

        $ticketData = [
            'totalTickets' => $totalTickets,
            'openTickets' => $openTickets,
            'closedTickets' => $closedTickets,
            'notAssigned' => $notAssigned,
        ];

        return ($ticketData);
    }

    // public function dateFormat($date)
    // {
    //     return Carbon::parse($date)->format('d-m-Y');
    // }
    
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('dashboard', function ($view) {
            $view->with('ticketData', function () {
                return $this->ticketData();
            });
        });
    }
}