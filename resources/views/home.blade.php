@extends('layouts.app')

@section('content')

<div class="container mt-4">

    @if(Auth::user()->hasRole('admin'))
        <!-- Composant ADMIN avec toutes les données -->
        <x-dashboards.admin-dashboard
            :questionsToday="$questionsToday ?? 0"
            :questionsThisWeek="$questionsThisWeek ?? 0"
            :questionsThisMonth="$questionsThisMonth ?? 0"
            :questionsThisYear="$questionsThisYear ?? 0"
            :questionsAllTime="$questionsAllTime ?? 0"
            
            :correctAnswersPercentageToday="$correctAnswersPercentageToday ?? 0"
            :correctAnswersPercentageThisWeek="$correctAnswersPercentageThisWeek ?? 0"
            :correctAnswersPercentageThisMonth="$correctAnswersPercentageThisMonth ?? 0"
            :correctAnswersPercentageThisYear="$correctAnswersPercentageThisYear ?? 0"
            :correctAnswersPercentageAllTime="$correctAnswersPercentageAllTime ?? 0"
            
            :newUsersToday="$newUsersToday ?? 0"
            :newUsersThisWeek="$newUsersThisWeek ?? 0"
            :newUsersThisMonth="$newUsersThisMonth ?? 0"
            :newUsersThisYear="$newUsersThisYear ?? 0"
            :newUsersAllTime="$newUsersAllTime ?? 0"
            
            :categoriesToday="$categoriesToday ?? collect()"
            :categoriesThisWeek="$categoriesThisWeek ?? collect()"
            :categoriesThisMonth="$categoriesThisMonth ?? collect()"
            :categoriesThisYear="$categoriesThisYear ?? collect()"
            :categoriesAllTime="$categoriesAllTime ?? collect()"
            
            :personalQuestionsToday="$personalQuestionsToday ?? 0"
            :personalQuestionsThisWeek="$personalQuestionsThisWeek ?? 0"
            :personalQuestionsThisMonth="$personalQuestionsThisMonth ?? 0"
            :personalQuestionsThisYear="$personalQuestionsThisYear ?? 0"
            :personalQuestionsAllTime="$personalQuestionsAllTime ?? 0"
            
            :personalCorrectAnswersPercentageToday="$personalCorrectAnswersPercentageToday ?? 0"
            :personalCorrectAnswersPercentageThisWeek="$personalCorrectAnswersPercentageThisWeek ?? 0"
            :personalCorrectAnswersPercentageThisMonth="$personalCorrectAnswersPercentageThisMonth ?? 0"
            :personalCorrectAnswersPercentageThisYear="$personalCorrectAnswersPercentageThisYear ?? 0"
            :personalCorrectAnswersPercentageAllTime="$personalCorrectAnswersPercentageAllTime ?? 0"
            
            :personalCategoriesToday="$personalCategoriesToday ?? collect()"
            :personalCategoriesThisWeek="$personalCategoriesThisWeek ?? collect()"
            :personalCategoriesThisMonth="$personalCategoriesThisMonth ?? collect()"
            :personalCategoriesThisYear="$personalCategoriesThisYear ?? collect()"
            :personalCategoriesAllTime="$personalCategoriesAllTime ?? collect()"
            
            :game="$game"
        />

    @else
        <!-- Composant USER avec ses données perso -->
        <x-dashboards.user-dashboard
            :personalQuestionsToday="$personalQuestionsToday ?? 0"
            :personalQuestionsThisWeek="$personalQuestionsThisWeek ?? 0"
            :personalQuestionsThisMonth="$personalQuestionsThisMonth ?? 0"
            :personalQuestionsThisYear="$personalQuestionsThisYear ?? 0"
            :personalQuestionsAllTime="$personalQuestionsAllTime ?? 0"
            
            :personalCorrectAnswersPercentageToday="$personalCorrectAnswersPercentageToday ?? 0"
            :personalCorrectAnswersPercentageThisWeek="$personalCorrectAnswersPercentageThisWeek ?? 0"
            :personalCorrectAnswersPercentageThisMonth="$personalCorrectAnswersPercentageThisMonth ?? 0"
            :personalCorrectAnswersPercentageThisYear="$personalCorrectAnswersPercentageThisYear ?? 0"
            :personalCorrectAnswersPercentageAllTime="$personalCorrectAnswersPercentageAllTime ?? 0"
            
            :personalCategoriesToday="$personalCategoriesToday ?? collect()"
            :personalCategoriesThisWeek="$personalCategoriesThisWeek ?? collect()"
            :personalCategoriesThisMonth="$personalCategoriesThisMonth ?? collect()"
            :personalCategoriesThisYear="$personalCategoriesThisYear ?? collect()"
            :personalCategoriesAllTime="$personalCategoriesAllTime ?? collect()"
            
            :game="$game"
        />
    @endif

</div>

@endsection