@extends('frontend.layouts.app')

@section('content')
    <button class="btn btn-primary btn-sm" id="addGame">Add</button>
    <table class="table" id="gameTable">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Creator</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <!-- Data will be loaded here dynamically -->
        </tbody>
    </table>

    <!-- Add Game Modal -->
    <div class="modal fade" id="addGameModal" tabindex="-1" aria-labelledby="addGameModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGameModalLabel">Add New Game</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addGameForm" action="{{ route('game.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="gameName" class="form-label">Game Name</label>
                            <input type="text" class="form-control" id="gameName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="gameCreator" class="form-label">Creator</label>
                            <input type="text" class="form-control" id="gameCreator" name="creator" required>
                        </div>
                        <div class="mb-3">
                            <label for="gameImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="gameImage" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Game</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                                <td>${game.image ? game.image : 'NA'}</td>
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

    <script>
        $(document).ready(function () {
           $('#addGame').on('click', function () {
               $('#addGameModal').modal('show')
           })
        })
        $('#addGameForm').on('submit', function (e) {
            e.preventDefault();

            let formData = $('#addGameForm').serialize()
         
            $.ajax({
                url: "{{ route('game.store') }}",
                data: formData,
                method: "post",

                success: function (response) {
                    console.log(response.msg)
                }
            })
            $('#addGameModal').hide()
        })
    </script>
@endsection
