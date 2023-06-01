<!DOCTYPE html>
<html>
<head>
    <title>Checkout Confirmation</title>
</head>
<body>
    <h1>Checkout Confirmation</h1>
    <p>Thank you for your purchase!</p>
    <p>Order ID: {{ $order->id }}</p>

    <h2>Tickets Purchased:</h2>
    <ul>
        @foreach ($ticketsDetails as $ticketDetail)
            @php
            $ticket = $ticketDetail->ticket;
            $home_team = $ticket->matchgame->teamsPlayingMatch[0]->team->team_name;
            $away_team = $ticket->matchgame->teamsPlayingMatch[1]->team->team_name;
            $playing_on_date = $ticket->matchgame->played_on_date;
            $playing_on_time = $ticket->matchgame->played_on_time;
            $stadium_zone = $ticket->zone;
            $stadium = $ticket->matchgame->stadium->stadium_name;
            @endphp
            <li>
                 {{$home_team}} vs {{$away_team}} | {{$playing_on_date}} {{$playing_on_time}}
            </li>
            <li>
                {{$stadium}} Zone: {{$stadium_zone->stadium_location}}
            </li>
            <li>
                Price: {{$ticket->base_price + $stadium_zone->price_addition}}
                Quantity: {{ $ticketDetail->ticket_quantity }}
            </li>

        @endforeach
    </ul>

    <p>Total Price: {{ $totalPrice }}</p>
</body>
</html>
