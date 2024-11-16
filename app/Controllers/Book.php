<?php
namespace App\Controllers;
use App\Models\BookModel;
class Book extends BaseController{

    public function index(){
        echo view('books/list');
            }


        public function create(){
            $validation = \Config\Services::session();
            helper('form');

            $data = [];

            if ($this->request->getMethod() == 'post'){
                $input = $this->validate([
                    'name' => 'required|min_length[5]',
                    'author' => 'required|min_length[5],'
                ]);

                if($input == true) {
                    //Form validated successfully, so we can save values to database
                    $model = new BookModel();

                    $model->save([
                        'name' =>this->request->getPost('name'),
                        'author' =>this->request->getPost('author'),
                        'isbn_no' =>this->request->getPost('isbn_no'),

                    ]);

                    $session->setFlashdata('success','record added successfully.');

                    return redirect()->to('books');
                } else {
                    //Form not validated successfully

                    $data['validation'] = $this->validator;
                }

            }

            return view('books/create',$data);
        }
}



?>