@extends('admin.inc.main')

@section('Admin-contents')

<style>
    .filters {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .filters input, .filters select{
        padding: 10px 15px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        background: var(--card-bg);
        color: var(--text-color);
        font-size: 0.95rem;
        min-width: 200px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .filters input:focus, .filters select:focus{
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(13, 71, 161, 0.2);
    }

    .table-container {
        overflow-x: auto;
        box-shadow: 0 8px 16px var(--card-shadow);
        border-radius: 12px;
        background: var(--card-bg);
        margin-bottom: 50px;
    }

    #feedbackTable {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }

    #feedbackTable thead tr {
        background-color: var(--primary);
        color: white;
        text-align: left;
        user-select: none;
    }

    #feedbackTable th, #feedbackTable td {
        padding: 16px 20px;
        border-bottom: 1px solid var(--border-color);
    }

    #feedbackTable th {
        font-weight: 600;
        font-family: 'Montserrat', sans-serif;
    }

    #feedbackTable td {
        color: var(--text-color);
    }

    #feedbackTable tbody tr:last-child td {
        border-bottom: none;
    }

    #feedbackTable tbody tr:hover {
        background-color: var(--primary-light);
        cursor: pointer;
    }

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

    @media (max-width: 768px) {
        .filters {
            flex-direction: column;
            gap: 10px;
        }
        
        .filters input, .filters select {
            width: 100%;
            min-width: auto;
        }
        
        #feedbackTable th, #feedbackTable td {
            padding: 12px 15px;
        }
    }
</style>

<main class="main-content">
    <div class="main-container">
        <header class="page-header">
            <p>Manage the feedbacks.</p>
        </header>

        <!-- Search and Filters -->
        <form method="GET" action="{{ route('admin.feedbacks') }}" class="filters">
            <input type="text" name="search" placeholder="Search feedback..." value="{{ request('search') }}">
            <input type="date" name="date" value="{{ request('date') }}">
            <button type="submit" class="btn btn-view">Filter</button>
        </form>

        <div class="table-container">
            <table id="feedbackTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Submitted On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($feedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->name }}</td>
                            <td>{{ $feedback->email }}</td>
                            <td>{{ Str::limit($feedback->message, 50) }}</td>
                            <td>{{ $feedback->created_at->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('admin.feedback.delete', $feedback->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">
                                        <svg class="btn-icon" ...>...</svg>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-6">
                                No feedbacks yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>


@endsection
