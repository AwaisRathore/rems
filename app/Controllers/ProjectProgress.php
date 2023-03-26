<?php

namespace App\Controllers;

use function PHPUnit\Framework\isNull;

class ProjectProgress extends BaseController
{
    private $progressModel = NULL;
    private $auth = NULL;

    public function __construct()
    {
        $this->progressModel = new \App\Models\ProgressModel();
        $this->auth = service("auth");
    }

    public function new($project_id)
    {

        $user_id = session()->get('user_id');

        if ($this->request->getMethod() == 'post') {
            // helper(['form', 'url']);

            $file = $this->request->getFile('progress_file');




            $filename = array();
            $files = $this->request->getFileMultiple("progress_file");
            if (!empty($files[0]->getname())) {
                $filedir = 'public/assets/projectfile/';
                $filename = [];
                foreach ($files as $file) {
                    if ($file->move(ROOTPATH . $filedir, $file->getRandomName())) {
                        array_push(
                            $filename,
                            $filedir . $file->getName()
                        );
                    }
                }
            }

            // dd($filename);

            $data = [
                'progress' => $this->request->getPost('range'),
                'start_time' => $this->request->getPost('start_time'),
                'end_time' => $this->request->getPost('end_time'),
                'project_id' => $project_id,
                'user_id' => $user_id,
                'description' => $this->request->getPost('notes'),
                'file' => $filename
            ];
            // dd($data);
            if ($this->progressModel->addprogress($data)) {
                return redirect()->back();
            } else {
                return redirect()->back()->withInput()->with('errors', $this->progressModel->errors())->with('warning', "Please fix the errors");
            }
        }
    }
}
