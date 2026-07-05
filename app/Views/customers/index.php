<section class="flex flex-col sm:flex-row justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold">Customer Management</h1>
        <p class="text-gray-500 mt-2">Manage bookstore customers.</p>
    </div>

    <a href="/customers/create"
        class="mt-4 sm:mt-0 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
        + Create Customer
    </a>
</section>

<form method="GET" action="/customers"
    class="bg-gray-50 border rounded-lg p-4 mb-6 flex flex-wrap gap-3">
    <input type="text"
        name="keyword"
        value="<?= e($keyword ?? '') ?>"
        placeholder="Search customer..."
        class="border rounded-lg px-3 py-2 w-72">

    <select name="sort" class="border rounded-lg px-3 py-2">
        <option value="created_at">Created</option>
        <option value="name">Name</option>
        <option value="email">Email</option>
    </select>

    <select name="direction" class="border rounded-lg px-3 py-2">
        <option value="desc">DESC</option>
        <option value="asc">ASC</option>
    </select>

    <button class="bg-slate-900 text-white px-5 rounded-lg">
        Filter
    </button>
</form>

<div class="overflow-x-auto border rounded-lg">
    <table class="w-full">
        <thead class="bg-slate-50">
            <tr>
                <th class="p-3">ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-3"><?= e($customer['id']) ?></td>
                    <td><?= e($customer['name']) ?></td>
                    <td><?= e($customer['email']) ?></td>
                    <td><?= e($customer['phone']) ?></td>
                    <td><?= e($customer['address']) ?></td>
                    <td><?= e($customer['created_at']) ?></td>
                    <td>
                        <div class="flex gap-2">
                            <a href="/customers/edit?id=<?= $customer['id'] ?>"
                                class="bg-blue-600 text-white px-3 py-1 rounded">Edit</a>

                            <form method="POST" action="/customers/delete">
                                <input type="hidden" name="id" value="<?= $customer['id'] ?>">
                                <button onclick="return confirm('Delete?')"
                                    class="bg-red-600 text-white px-3 py-1 rounded">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="flex justify-between items-center mt-6">
    <div class="text-sm text-gray-600">
        Showing
        <strong><?= (($page-1)*$limit)+1 ?></strong>
        -
        <strong><?= min($page*$limit,$total) ?></strong>
        of
        <strong><?= $total ?></strong>
        customers
    </div>

    <div class="flex gap-2">
        <?php if($page>1): ?>
        <a
            href="/customers?<?=query_string(['page'=>$page-1])?>"
            class="px-3 py-2 border rounded hover:bg-gray-100">
            Previous
        </a>
        <?php endif; ?>
        <?php for($i=1;$i<=$totalPages;$i++): ?>
        <a
            href="/customers?<?=query_string(['page'=>$i])?>"
            class="px-3 py-2 border rounded
            <?= $i==$page
                ? 'bg-blue-600 text-white'
                : 'bg-white hover:bg-gray-100'
            ?>">
            <?= $i ?>
        </a>
        <?php endfor; ?>
        <?php if($page<$totalPages): ?>
        <a
            href="/customers?<?=query_string(['page'=>$page+1])?>"
            class="px-3 py-2 border rounded hover:bg-gray-100">
            Next
        </a>
        <?php endif; ?>
    </div>
</div>

