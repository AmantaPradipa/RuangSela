<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PsychotestModel;
use App\Models\TestQuestionModel;
use App\Models\QuestionOptionModel;

class PsychotestManagementController extends BaseController
{
    protected $psychotestModel;
    protected $testQuestionModel;
    protected $questionOptionModel;

    public function __construct()
    {
        $this->psychotestModel = new PsychotestModel();
        $this->testQuestionModel = new TestQuestionModel();
        $this->questionOptionModel = new QuestionOptionModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Psikotes',
            'psychotests' => $this->psychotestModel->findAll(),
        ];
        return view('admin/psychotests/psychotests_list', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Psikotes Baru',
        ];
        return view('admin/psychotests/create_psychotest', $data);
    }

    public function save()
    {
        $rules = [
            'title' => 'required|max_length[255]',
            'description' => 'permit_empty',
            'is_active' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'is_active' => $this->request->getPost('is_active'),
        ];

        if ($this->psychotestModel->save($data)) {
            return redirect()->to(base_url('admin/psychotests'))->with('success', 'Psikotes berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan Psikotes.');
        }
    }

    public function edit($id)
    {
        $psychotest = $this->psychotestModel->find($id);

        if (!$psychotest) {
            return redirect()->back()->with('error', 'Psikotes tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Psikotes',
            'psychotest' => $psychotest,
            'questions' => $this->testQuestionModel->where('psychotest_id', $id)->findAll(),
        ];
        return view('admin/psychotests/edit_psychotest', $data);
    }

    public function update($id)
    {
        $rules = [
            'title' => 'required|max_length[255]',
            'description' => 'permit_empty',
            'is_active' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'is_active' => $this->request->getPost('is_active'),
        ];

        if ($this->psychotestModel->update($id, $data)) {
            return redirect()->to(base_url('admin/psychotests'))->with('success', 'Psikotes berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui Psikotes.');
        }
    }

    public function delete($id)
    {
        if ($this->psychotestModel->delete($id)) {
            return redirect()->back()->with('success', 'Psikotes berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus Psikotes.');
        }
    }

    public function manageQuestions($psychotestId)
    {
        $psychotest = $this->psychotestModel->find($psychotestId);

        if (!$psychotest) {
            return redirect()->back()->with('error', 'Psikotes tidak ditemukan.');
        }

        $questions = $this->testQuestionModel->where('psychotest_id', $psychotestId)->orderBy('question_order', 'ASC')->findAll();

        foreach ($questions as &$question) {
            $question->options = $this->questionOptionModel->where('question_id', $question->id)->findAll();
        }

        $data = [
            'title' => 'Manajemen Pertanyaan untuk ' . $psychotest->title,
            'psychotest' => $psychotest,
            'questions' => $questions,
        ];
        return view('admin/psychotests/manage_questions', $data);
    }

    public function saveQuestion()
    {
        $rules = [
            'psychotest_id' => 'required|numeric',
            'question' => 'required',
            'question_order' => 'required|numeric',
            'options' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $psychotestId = $this->request->getPost('psychotest_id');
        $questionText = $this->request->getPost('question');
        $questionOrder = $this->request->getPost('question_order');
        $options = $this->request->getPost('options'); // Array of option_text and score

        $questionData = [
            'psychotest_id' => $psychotestId,
            'question' => $questionText,
            'question_order' => $questionOrder,
        ];

        $this->testQuestionModel->save($questionData);
        $questionId = $this->testQuestionModel->getInsertID();

        foreach ($options as $option) {
            $optionData = [
                'question_id' => $questionId,
                'option_text' => $option['text'],
                'score' => $option['score'],
            ];
            $this->questionOptionModel->save($optionData);
        }

        return redirect()->to(base_url('admin/psychotests/manage_questions/' . $psychotestId))->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function deleteQuestion($id)
    {
        $question = $this->testQuestionModel->find($id);

        if (!$question) {
            return redirect()->back()->with('error', 'Pertanyaan tidak ditemukan.');
        }

        $psychotestId = $question->psychotest_id;

        if ($this->testQuestionModel->delete($id)) {
            return redirect()->to(base_url('admin/psychotests/manage_questions/' . $psychotestId))->with('success', 'Pertanyaan berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus pertanyaan.');
        }
    }
}
