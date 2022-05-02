<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Scoreboard</title>

  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Nunito', sans-serif;
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }

    .bg-red {
      background-color: rgb(247, 185, 185) !important;
    }

  </style>
</head>

<body class="antialiased">
  <table>
    <tr>
      <th>#</th>
      <th>id</th>
      <th>Name</th>
      <th>score</th>
    </tr>
    @foreach ($data as $item)
      <tr {{ $item->id == $userId ? 'class=bg-red' : '' }}>
        <td>{{ $item->position }}</td>
        <td>{{ $item->id }}</td>
        <td><img width="20" height="20" src="{{ $item->url }}" alt="">
          {{ $item->username }}</td>
        <td>{{ $item->karma_score }}</td>
      </tr>
    @endforeach
  </table>

</body>

</html>
