<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\PsychotestModel;
use App\Models\TestQuestionModel;
use App\Models\QuestionOptionModel;
use App\Models\TestResultModel;

class PsychotestController extends BaseController
{
    protected $psychotestModel;
    protected $testQuestionModel;
    protected $questionOptionModel;
    protected $testResultModel;

    public function __construct()
    {
        $this->psychotestModel = new PsychotestModel();
        $this->testQuestionModel = new TestQuestionModel();
        $this->questionOptionModel = new QuestionOptionModel();
        $this->testResultModel = new TestResultModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Psikotes',
            'tests' => $this->psychotestModel->where('is_active', 1)->findAll(),
        ];
        return view('client/psychotests/psychotests_list', $data);
    }

    public function take($psychotestId)
    {
        $psychotest = $this->psychotestModel->find($psychotestId);

        if (!$psychotest) {
            return redirect()->back()->with('error', 'Tes psikologi tidak ditemukan.');
        }

        $questions = $this->testQuestionModel->where('psychotest_id', $psychotestId)->orderBy('question_order', 'ASC')->findAll();

        foreach ($questions as &$question) {
            $question->options = $this->questionOptionModel->where('question_id', $question->id)->findAll();
        }

        $data = [
            'title' => 'Mulai Psikotes: ' . $psychotest->title,
            'psychotest' => $psychotest,
            'questions' => $questions,
        ];
        return view('client/psychotests/take_test', $data);
    }

    public function submitTest()
    {
        $psychotestId = $this->request->getPost('psychotest_id');
        $psychotest = $this->psychotestModel->find($psychotestId);

        if (!$psychotest) {
            return redirect()->back()->with('error', 'Tes psikologi tidak ditemukan.');
        }

        $totalScore = 0;
        $questions = $this->testQuestionModel->where('psychotest_id', $psychotestId)->findAll();

        foreach ($questions as $question) {
            $selectedOptionId = $this->request->getPost('question_' . $question->id);
            if ($selectedOptionId) {
                $option = $this->questionOptionModel->find($selectedOptionId);
                if ($option) {
                    $totalScore += $option['score'];
                }
            }
        }

        // Simple result summary based on score (this would be more complex in a real app)
        $resultSummary = 'Hasil tes Anda menunjukkan skor ' . $totalScore . '.';
        if ($totalScore < 50) {
            $resultSummary .= ' Anda mungkin perlu perhatian lebih pada kesehatan mental Anda.';
        } elseif ($totalScore < 80) {
            $resultSummary .= ' Anda memiliki kesehatan mental yang cukup baik.';
        } else {
            $resultSummary .= ' Selamat! Kesehatan mental Anda sangat baik.';
        }

        $testResultData = [
            'user_id' => session()->get('user_id'),
            'psychotest_id' => $psychotestId,
            'total_score' => $totalScore,
            'result_summary' => $resultSummary,
        ];

        if ($this->testResultModel->save($testResultData)) {
            return redirect()->to(base_url('client/psychotests/result/' . $this->testResultModel->getInsertID()))->with('success', 'Tes berhasil diselesaikan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan hasil tes.');
        }
    }

    public function result($resultId)
    {
        $testResult = $this->testResultModel->find($resultId);

        if (!$testResult || $testResult['user_id'] !== session()->get('user_id')) {
            return redirect()->back()->with('error', 'Hasil tes tidak ditemukan atau Anda tidak memiliki akses.');
        }

        $psychotest = $this->psychotestModel->find($testResult['psychotest_id']);

        $data = [
            'title' => 'Hasil Psikotes: ' . $psychotest->title,
            'testResult' => $testResult,
            'psychotest' => $psychotest,
        ];
        return view('client/psychotests/test_result', $data);
    }
}
