<?php

/**
 * Checks if the book id is set for return.
 * This is use for displaying the right borrowed
 * books on the reservation module
 *
 * @param $id
 *
 * @return boolean
 */
function isSetForReturn($id)
{
    $books = Session::get('books');

    for ($index = 0; $index < count($books); ++$index) {
        if ($books[$index]->id == $id) {
            return true;
        }
    }

    return false;
}

/**
 * Computes for the penalty of a book. checks the
 * return_date of the book and what is set on the
 * environment file.
 *
 * @param Book $book
 *
 * @return int
 */
function computeForPenalty(App\Models\Book $book)
{
    $date_borrowed = $book->borrower()->first()->pivot->created_at;

    $date1 = new DateTime($date_borrowed);
    $date2 = new DateTime(date('Y-m-d'));

    //checking for holidays, and sundays
    $interval = DateInterval::createFromDateString('1 day');
    $period = new DatePeriod($date1, $interval, $date2);

    $notCountedDays = 0;
    foreach ($period as $date) {
        if ($date->format('N') > 6) {
            $notCountedDays++;
        }

        $holidays = App\Models\Holiday::all();
        foreach ($holidays as $holiday) {
            $holiday_date = new DateTime($holiday->date);

            if ($holiday_date->format('Y-m-d') == $date->format('Y-m-d')) {
                $notCountedDays++;
            }
        }
    }

    $diff = $date1->diff($date2)->format("%a");

    $multiplier = 1;

    if (Auth::user()->role()->first()->name == 'Student') {
        $multiplier = 5;
    } else {
        $multiplier = 25;
    }

    return ($diff - $notCountedDays) * $multiplier;
}
