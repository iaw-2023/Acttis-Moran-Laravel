<!DOCTYPE html>
<html>
<head>
    <title>Checkout Confirmation</title>
</head>
<body>
    <h1>Checkout Confirmation</h1>
    <h4>Thank you for your purchase!</h4>
    <p>Order ID Reference: {{ $order->id }}</p>

    <h3>Tickets Purchased:</h3>
    
        @foreach ($ticketsDetails as $ticketDetail)
            <ul>
                @php
                $ticket = $ticketDetail->ticket;
                $home_team = $ticket->matchgame->teamsPlayingMatch[0]->team->team_name;
                $away_team = $ticket->matchgame->teamsPlayingMatch[1]->team->team_name;
                $playing_on_date = $ticket->matchgame->played_on_date;
                $playing_on_time = $ticket->matchgame->played_on_time;
                $stadium_zone = $ticket->zone;
                $stadium = $ticket->matchgame->stadium->stadium_name;
                @endphp
                <p>Ticket : </p>
                <li>
                     {{$home_team}} vs {{$away_team}}
                </li>
                <li>
                     {{$playing_on_date}} {{$playing_on_time}}
                </li>
                <li>
                    {{$stadium}} | {{$stadium_zone->stadium_location}}
                </li>
                <li>
                    Ticket price: ${{$ticket->base_price + $stadium_zone->price_addition}}
                </li>
                <li>
                    Ticket quantity: {{ $ticketDetail->ticket_quantity }}
                </li>
            </ul>
        @endforeach
    

    <p>Order Total Price: {{ $totalPrice }}</p>
</body>
</html>
