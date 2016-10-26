<?php

namespace FoggyLine\Office\Controller\Test;

use FoggyLine\Office\Controller\Test;
use FoggyLine\Office\Model\DepartmentFactory;
use FoggyLine\Office\Model\Employee;
use Magento\Framework\App\Action\Context;
use FoggyLine\Office\Model\EmployeeFactory;
use Magento\Framework\App\RequestInterface;

class Crud extends Test
{
    protected $employee;

    protected $department;

    public function __construct(Context $context, EmployeeFactory $employee, DepartmentFactory $department)
    {
        $this->employee = $employee;
        $this->department = $department;
        return parent::__construct($context);
    }

    private function gForm()
    {
        return '
<p>Create a new Employee</p>
                    <form method="GET">
                        <input type="text" name="first_name" placeholder="First Name">
                        <input type="text" name="email" placeholder="Email">
                        <input type="hidden" name="action" value="create">
                        <button type="submit" class="btn btn-success">Create</button>
                    </form>';
    }

    private function cGet()
    {
        $td = '<tr><td>{{id}}</td><td>{{first_name}}</td><td>{{email}}</td><td>{{salary}}</td><td><a href="?action=delete&id={{id}}">Delete</a><br><a href="?action=edit&id={{id}}">Random Salary</a></td></tr>';
        $acumulator = '';
        /** @var Employee $employee */
        $collection = $this->employee->create()->getCollection()->addAttributeToSelect('*');
        $filter = $this->getRequest()->getParam('filter');
        if (is_array($filter) && count($filter)) {
            foreach ($filter as $item => $value) {
                $collection->addAttributeToFilter($item, array(
                    'like' => '%' . $value . '%'
                ));
            }
        }

        foreach ($collection as $employee) {
            $values = array(
                'email' => $employee->getEmail(),
                'first_name' => $employee->getFirstName(),
                'salary' => $employee->getSalary(),
                'id' => $employee->getId(),
            );
            $acumulator .= $this->replace($td, $values);
        }
        return sprintf('<table class="table"><tr><th>ID</th><th>First Name</th><th>Email</th><th>Salary</th><th>Actions</th></tr>%s</table>',
            $acumulator);
    }


    private function create($firstName, $email)
    {
        $employee = $this->employee->create();
        $employee
            ->setVatNumber(1234)
            ->setNote(rand(12.00, 30.00))
            ->setFirstName($firstName)
            ->setEmail($email)
            ->setSalary(0)
            ->setServiceYears(rand(1, 10))
            ->setDob('2016-01-01')
            ->setDepartmentId(2);
        $employee->save();
    }

    private function update($id)
    {
        $employee = $this->employee->create();
        $employee
            ->load($id)
            ->setSalary(rand(1, 1000));
        $employee->save();
    }

    public function execute()
    {
        echo '<h1>Employee CRUD</h1>';
        $action = ($this->getRequest()->getParam('action'));
        switch ($action) {
            case 'create';
                $firstName = $this->getRequest()->getParam('first_name');
                $email = $this->getRequest()->getParam('email');
                $this->create($firstName, $email);
                break;
            case 'read':
                break;
            case 'edit':
                $id = ($this->getRequest()->getParam('id'));
                $this->update($id);
                break;
            case 'delete':
                $id = ($this->getRequest()->getParam('id'));
                $this->employee->create()->load($id)->delete();
                break;
            default:
                break;
        }
        $toPrint = array(
            'form' => $this->gForm(),
            'collection' => $this->cGet(),
            'filter' => $this->cFilter(),
        );
        $this->printDoc($toPrint);
    }

    private function printDoc(array $elements)
    {
        $html = '
                <!DOCTYPE html><html>
                <head>
                <meta charset="utf-8">
                <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
                </head>
                <body class="container">
                <div class="row">
                    {{form}}
                    </div>
                <div class="row">          
                    {{filter}}
                    </div>
                <div class="row">
                    <div class="col-lg-12">
                        {{collection}}
                    </div>
                </div>
                </body>
                <script type="text/javascript" async="" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                </html>';
        $html = $this->replace($html, $elements);

        echo $html;
    }

    private function replace($text, array $elements)
    {
        foreach ($elements as $k => $v) {
            $text = str_replace(sprintf('{{%s}}', $k), isset($v) ? $v : 'not setted', $text);
        }
        return $text;
    }

    private function cFilter()
    {
        $filterValues = $this->getRequest()->getParam('filter');
        $filterValues = is_array($filterValues) ? $filterValues : array('first_name' => '' , 'email' => '');
        $filter = '
<p>Find and Employee</p>
                <form method="GET">
                                   
                    <input type="text" name="filter[first_name]" value="{{first_name}}" placeholder="First Name">
                    <input type="text" name="filter[email]" value="{{email}}" placeholder="Email">
                    <input type="hidden" name="action" value="filter" >
                    <button type="submit" class="btn btn-success">Filter</button>
                </form>
                ';
        $filter = $this->replace($filter, $filterValues);
        return $filter;
    }

}