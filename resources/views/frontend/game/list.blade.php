@extends('frontend.layouts.app')

@section('content')
    <table class="table" id="gameTable">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Creator</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <!-- Data will be loaded here dynamically -->
        </tbody>
    </table>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            // Function to load game data
            function loadGames() {
                $.ajax({
                    url: "{{ route('game.ajax.list') }}",
                    method: "GET",
                    success: function (response) {
                        if (response.success) {
                            let games = response.data;
                            let rows = '';

                            // Generate table rows
                            games.forEach((game, index) => {
                                rows += `
                            <tr>
                                <th scope="row">${index + 1}</th>
                                <td>${game.name}</td>
                                <td>${game.creator}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        `;
                            });

                            // Populate table body
                            $('#gameTable tbody').html(rows);
                        } else {
                            alert('Failed to fetch game data.');
                        }
                    },
                    error: function () {
                        alert('An error occurred while fetching game data.');
                    }
                });
            }

            // Call the function to load games on page load
            loadGames();
        });
    </script>
@endsection
