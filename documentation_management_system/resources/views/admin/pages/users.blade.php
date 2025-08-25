@extends('admin.inc.main')

@section('Admin-contents')

<style>

    .filters {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .filters input{
        padding: 10px 15px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        background: var(--card-bg);
        color: var(--text-color);
        font-size: 0.95rem;
        min-width: 200px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .filters input:focus{
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(13, 71, 161, 0.2);
    }

    /* Table Section */
    .table-container {
        overflow-x: auto;
        box-shadow: 0 8px 16px var(--card-shadow);
        border-radius: 12px;
        background: var(--card-bg);
        margin-bottom: 50px;
    }

    #documentsTable {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }

    #documentsTable thead tr {
        background-color: var(--primary);
        color: white;
        text-align: left;
        user-select: none;
    }

    #documentsTable th, #documentsTable td {
        padding: 16px 20px;
        border-bottom: 1px solid var(--border-color);
    }

    #documentsTable th {
        font-weight: 600;
        font-family: 'Montserrat', sans-serif;
    }

    #documentsTable td {
        color: var(--text-color);
    }

    #documentsTable tbody tr:last-child td {
        border-bottom: none;
    }

    #documentsTable tbody tr:hover {
        background-color: var(--primary-light);
        cursor: pointer;
    }

    /* Buttons */
    .btn {
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-view {
        background-color: rgba(13, 71, 161, 0.1);
        color: var(--primary);
    }

    .btn-view:hover {
        background-color: rgba(13, 71, 161, 0.2);
    }

    .btn-edit {
        background-color: rgba(46, 125, 50, 0.1);
        color: var(--success);
    }

    .btn-edit:hover {
        background-color: rgba(46, 125, 50, 0.2);
    }

    .btn-delete {
        background-color: rgba(198, 40, 40, 0.1);
        color: var(--error);
    }

    .btn-delete:hover {
        background-color: rgba(198, 40, 40, 0.2);
    }

    .btn-icon {
        width: 16px;
        height: 16px;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(2px);
    }

    .modal-content {
        background: var(--card-bg);
        margin: 10% auto;
        padding: 30px;
        border-radius: 12px;
        width: 400px;
        max-width: 90%;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .modal-content p {
        margin-bottom: 25px;
        font-size: 1.1rem;
        color: var(--text-color);
    }

    .modal-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .filters {
            flex-direction: column;
            gap: 10px;
        }
        
        .filters input, .filters select {
            width: 100%;
            min-width: auto;
        }
        
        #documentsTable th, #documentsTable td {
            padding: 12px 15px;
        }
    }
</style>

<main class="main-content">
    <div class="main-container">
        <header class="page-header">
            <p>Manage the users.</p>
        </header>

 <!-- Search and Filters -->
 <form method="GET" action="{{ route('admin.users') }}" class="filters">
    <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}">
    <input type="date" name="date" value="{{ request('date') }}">
    <button type="submit" class="btn btn-view">Filter</button>
</form>


        <div class="table-container">
            <table id="usersTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div style="display: flex; gap: 8px; align-items: center;">
                                    <a href="{{ route('admin.users.view', $user->id) }}" class="btn btn-view" style="text-decoration: none">
                                        <svg class="btn-icon" ...>...</svg>
                                        View
                                    </a>
                                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-edit" style="text-decoration: none">
                                        <svg class="btn-icon" ...>...</svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">
                                            <svg class="btn-icon" ...>...</svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</main>

<!-- Delete Modal -->
<div id="userDeleteModal" class="modal">
    <div class="modal-content">
        <p>Are you sure you want to delete this user?</p>
        <div class="modal-buttons">
            <button class="btn btn-delete" onclick="deleteUser()">Yes, Delete</button>
            <button class="btn btn-view" onclick="closeUserModal()">Cancel</button>
        </div>
    </div>
</div>

<script>
    function filterUsers() {
        const input = document.getElementById("searchUser").value.toLowerCase();
        const rows = document.querySelectorAll("#usersTable tbody tr");

        rows.forEach(row => {
            const title = row.cells[0].textContent.toLowerCase();
            row.style.display = title.includes(input) ? "" : "none";
        });
    }

    function viewUser() {
        alert("Viewing user details.");
    }

    function editUser() {
        alert("Redirect to edit user.");
    }

    let userRowToDelete = null;
    function confirmUserDelete(button) {
        userRowToDelete = button.closest("tr");
        document.getElementById("userDeleteModal").style.display = "block";
    }

    function closeUserModal() {
        document.getElementById("userDeleteModal").style.display = "none";
    }

    function deleteUser() {
        if (userRowToDelete) {
            userRowToDelete.remove();
            closeUserModal();
        }
    }
</script>
@endsection