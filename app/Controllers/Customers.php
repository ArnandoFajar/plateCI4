<?php

namespace App\Controllers;

use App\Models\CustomersModel;
use CodeIgniter\RESTful\ResourceController;
use Hermawan\DataTables\DataTable;
use Faker\Factory;

class Customers extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    public function index()
    {
        // $CustomerModel = new CustomersModel();
        //insert
        // $faker = Factory::create();
        // $array = [];
        // $number = 497;
        // for ($i = 1; $i < 100000; $i++) {
        //     $data = [
        //         'customerNumber'            => $number,
        //         'customerName'              => $faker->name,
        //         'phone'                     => $faker->phoneNumber,
        //         'city'                      => $faker->city,
        //         'country'                   => $faker->country,
        //         'postalCode'                => $faker->randomDigit,
        //         'salesRepEmployeeNumber'    => 1370
        //     ];
        //     try {
        //         $CustomerModel->insert($data);
        //     } catch (\Exception $th) {
        //         throw $th;
        //     }
        //     $number++;
        // }

        return view('customer/index');
    }

    /**
     * For Ajax getcustomers
     */
    public function getCustomers()
    {
        $CustomerModel = new CustomersModel();

        //can use query builder or model
        // $builder = $db->table('customers')->select('customerNumber, customerName, phone, city, country, postalCode');
        $builder = $CustomerModel->select('customerNumber, customerName, phone, city, country, employees.firstName AS employeeName')->join('employees', 'employees.employeeNumber = customers.salesRepEmployeeNumber');

        return DataTable::of($builder)->toJson();
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
