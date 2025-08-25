@extends('admin.inc.main')

@section('Admin-contents')

<style>

    .filters {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .filters input, .filters select {
        padding: 10px 15px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        background: var(--card-bg);
        color: var(--text-color);
        font-size: 0.95rem;
        min-width: 200px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .filters input:focus, .filters select:focus {
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
            <p>Manage and publish helpful knowledge articles for your users.</p>
        </header>

 <!-- Search and Filters -->
 <div class="filters">
    <input type="text" id="searchInput" placeholder="Search documents..." onkeyup="filterTable()" />
    <select id="categoryFilter" onchange="filterTable()">
        <option value="">All Categories</option>
        <option value="legal">Legal</option>
        <option value="finance">Finance</option>
        <option value="education">Education</option>
    </select>
    <input type="date" id="dateFilter" onchange="filterTable()" />
</div>

        <div class="table-container">
            <table id="articlesTable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date Published</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Getting Started Guide</td>
                        <td>General</td>
                        <td>2025-07-01</td>
                        <td><span class="status-badge status-published">Published</span></td>
                        <td>
                            <button class="btn btn-view" onclick="viewArticle()">
                                <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View
                            </button>
                            <button class="btn btn-edit" onclick="editArticle()">
                                <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </button>
                            <button class="btn btn-delete" onclick="confirmArticleDelete(this)">
                                <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>FAQ and Troubleshooting</td>
                        <td>Support</td>
                        <td>2025-06-15</td>
                        <td><span class="status-badge status-draft">Draft</span></td>
                        <td>
                            <button class="btn btn-view" onclick="viewArticle()">
                                <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View
                            </button>
                            <button class="btn btn-edit" onclick="editArticle()">
                                <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </button>
                            <button class="btn btn-delete" onclick="confirmArticleDelete(this)">
                                <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Delete Modal -->
<div id="articleDeleteModal" class="modal">
    <div class="modal-content">
        <p>Are you sure you want to delete this article?</p>
        <div class="modal-buttons">
            <button class="btn btn-delete" onclick="deleteArticle()">Yes, Delete</button>
            <button class="btn btn-view" onclick="closeArticleModal()">Cancel</button>
        </div>
    </div>
</div>

<script>
    function filterArticles() {
        const input = document.getElementById("searchArticle").value.toLowerCase();
        const rows = document.querySelectorAll("#articlesTable tbody tr");

        rows.forEach(row => {
            const title = row.cells[0].textContent.toLowerCase();
            row.style.display = title.includes(input) ? "" : "none";
        });
    }

    function viewArticle() {
        alert("Viewing article details.");
    }

    function editArticle() {
        alert("Redirect to edit article.");
    }

    let articleRowToDelete = null;
    function confirmArticleDelete(button) {
        articleRowToDelete = button.closest("tr");
        document.getElementById("articleDeleteModal").style.display = "block";
    }

    function closeArticleModal() {
        document.getElementById("articleDeleteModal").style.display = "none";
    }

    function deleteArticle() {
        if (articleRowToDelete) {
            articleRowToDelete.remove();
            closeArticleModal();
        }
    }
</script>
@endsection