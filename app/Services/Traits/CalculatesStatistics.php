<?php

namespace App\Services\Traits;
use App\Models\User;     
use App\Models\Category;        
use App\Models\UserQuestion;              
use Carbon\Carbon;     

trait CalculatesStatistics
{
    // ===== MÉTHODES GLOBALES (toute l'application) =====

    protected function getCategoriesForPeriod(string $period)
    {
        $now = Carbon::now();
        $query = Category::withCount([
            'questions' => function ($q) use ($now, $period) {
                $q->join('user_question', 'questions.id', '=', 'user_question.question_id');
                $this->applyPeriodFilter($q, $period, $now, 'questions.created_at');
            }
        ]);

        return $query->orderBy('questions_count', 'desc')->get();
    }

    protected function getQuestionsCountForPeriod(string $period): int
    {
        $now = Carbon::now();
        $query = UserQuestion::query();
        $this->applyPeriodFilter($query, $period, $now);
        return $query->count();
    }

    protected function getCorrectAnswersPercentageForPeriod(string $period): float
    {
        $now = Carbon::now();
        $query = UserQuestion::query();
        $this->applyPeriodFilter($query, $period, $now);

        $total = $query->count();
        if ($total === 0) {
            return 0;
        }

        $correct = (clone $query)->where('answers_trues_count', '>', 0)->count();
        return round(($correct / $total) * 100, 0);
    }

    protected function getNewUsersCountForPeriod(string $period): int
    {
        $now = Carbon::now();
        $query = User::query();
        $this->applyPeriodFilter($query, $period, $now);
        return $query->count();
    }

    // ===== MÉTHODES PAR UTILISATEUR =====

    protected function getCategoriesForPeriodByUser(int $userId, string $period)
    {
        $now = Carbon::now();
        $query = Category::withCount([
            'questions' => function ($q) use ($userId, $now, $period) {
                $q->join('user_question', 'questions.id', '=', 'user_question.question_id')
                ->where('user_question.user_id', $userId);
                $this->applyPeriodFilter($q, $period, $now, 'questions.created_at');
            }
        ]);

        return $query->orderBy('questions_count', 'desc')->get();
    }

    protected function getQuestionsCountForPeriodByUser(int $userId, string $period): int
    {
        $now = Carbon::now();
        $query = UserQuestion::where('user_id', $userId);
        $this->applyPeriodFilter($query, $period, $now);
        return $query->count();
    }

    protected function getCorrectAnswersPercentageForPeriodByUser(int $userId, string $period): float
    {
        $now = Carbon::now();
        $query = UserQuestion::where('user_id', $userId);
        $this->applyPeriodFilter($query, $period, $now);

        $total = $query->count();
        if ($total === 0) {
            return 0;
        }

        $correct = (clone $query)->where('answers_trues_count', '>', 0)->count();
        return round(($correct / $total) * 100, 0);
    }

    protected function applyPeriodFilter($query, string $period, ?Carbon $now = null, string $column = 'created_at')
    {
        $now = $now ?? Carbon::now();

        match ($period) {
            'today' => $query->whereDate($column, $now->toDateString()),
            'week' => $query->whereBetween($column, [$now->startOfWeek(), $now->endOfWeek()]),
            'month' => $query->whereMonth($column, $now->month)->whereYear($column, $now->year),
            'year' => $query->whereYear($column, $now->year),
            'allTime' => null,
            default => null,
        };
    }
}