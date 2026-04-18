<form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">

@csrf

<input type="text" name="title" placeholder="Event Title">

<textarea name="description"></textarea>

<input type="date" name="event_date">

<input type="text" name="location" placeholder="Location">

<input type="file" name="cover_image">

<button type="submit">Create Event</button>

</form>