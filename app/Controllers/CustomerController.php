<?php
require_once __DIR__ . '/../Services/CustomerService.php';
class CustomerController
{
    private CustomerService $service;

    public function __construct()
    {
        $this->service = new CustomerService();
    }

    public function index(): void
    {
        require_login();

        $keyword = trim($_GET['q'] ?? '');

        $page = (int)($_GET['page'] ?? 1);

        $sort = $_GET['sort'] ?? 'created_at';

        $direction = $_GET['direction'] ?? 'desc';

        $result = $this->service->getCustomers(
            $keyword,
            $page,
            10,
            $sort,
            $direction
        );

        view('customers/index', [

            'title' => 'Customers',

            'view' => 'customers/index',

            'customers' => $result['customers'],

            'total' => $result['total'],

            'page' => $page,

            'keyword' => $keyword,

            'sort' => $sort,

            'direction' => $direction,

            'success' => get_flash('success')

        ]);
    }

    public function create(): void
    {
        require_login();

        view('customers/create', [

            'title' => 'Create Customer',

            'view' => 'customers/create',

            'errors' => get_flash('errors', []),

            'old' => get_flash('old', [])

        ]);
    }

    public function store(): void
    {
        require_login();

        check_rate_limit();

        if (!empty($_POST['website'])) {

            http_response_code(400);

            exit('Spam detected.');
        }

        try {

            $this->service->create($_POST);

            flash(
                'success',
                'Customer created successfully.'
            );

            redirect('/customers');
        } catch (DuplicateRecordException $e) {

            flash('errors', [
                'email' => $e->getMessage()
            ]);
        } catch (InvalidArgumentException $e) {

            flash(
                'errors',
                json_decode($e->getMessage(), true)
            );
        }

        flash('old', $_POST);

        redirect('/customers/create');
    }

    public function edit(): void
    {
        require_login();

        $id = (int)($_GET['id'] ?? 0);

        $customer = $this->service->find($id);

        if (!$customer) {

            http_response_code(404);

            view('errors/404', [
                'title' => '404',
                'view' => 'errors/404'
            ]);

            return;
        }

        view('customers/edit', [

            'title' => 'Edit Customer',

            'view' => 'customers/edit',

            'customer' => $customer,

            'errors' => get_flash('errors', [])

        ]);
    }

    public function update(): void
    {
        require_login();

        $id = (int)($_POST['id'] ?? 0);

        try {

            $this->service->update($id, $_POST);

            flash(
                'success',
                'Customer updated successfully.'
            );

            redirect('/customers');
        } catch (DuplicateRecordException $e) {

            flash('errors', [
                'email' => $e->getMessage()
            ]);
        } catch (InvalidArgumentException $e) {

            flash(
                'errors',
                json_decode($e->getMessage(), true)
            );
        }

        flash('old', $_POST);

        redirect("/customers/edit?id={$id}");
    }

    public function delete(): void
    {
        require_login();

        $id = (int)($_POST['id'] ?? 0);

        $this->service->delete($id);

        flash(
            'success',
            'Customer deleted successfully.'
        );

        redirect('/customers');
    }
}
