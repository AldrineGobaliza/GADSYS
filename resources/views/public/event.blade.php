<h1>GAD Events</h1>

@foreach($events as $event)

<div class="event-card">

<h2>{{ $event->title }}</h2>

<p>{{ $event->description }}</p>

<p>Date: {{ $event->event_date }}</p>

<p>Location: {{ $event->location }}</p>

</div>

@endforeach