<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\SaleItem;
use App\Models\Sale;
use Carbon\Carbon;
use DB;

class MetricsRepository
{
    /**
     * return all sales of the month
     */
    public function getMonthlySalesData($year, $month)
    {
        return $sales = Sale::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();
    }

    /**
     * return all sales of the year
     */
    public function getAnnualSalesData($year)
    {
        $months = [];
        $totalAmounts = [];

        $monthsArray = $this->getAllMonths($year);

        foreach ($monthsArray as $monthNo => $monthName) {

            $sales = $this->getMonthlySalesData($year, $monthNo);

            $totalAmount = $this->sumTotalAmount($sales);

            array_push($months, $monthName);
            array_push($totalAmounts, $totalAmount);
        }

        return [
            'months' => $months,
            'total_amount_data' => $totalAmounts
        ];
    }

    /**
     * return current month total amount of sales
     */
    public function getCurrentMonthAmount()
    {
        $today = Carbon::now();

        $sales = $this->getMonthlySalesData($today->year, $today->month);

        $total = $this->sumTotalAmount($sales);

        return $total;
    }

    /**
     * return the daily amount
     */
    public function dailyAmount()
    {
        $today = Carbon::now();

        $sales = Sale::whereDate('created_at', $today)->get();

        $total = $this->sumTotalAmount($sales);

        return $total;
    }

    /**
     * calculate the total amount of the sales
     */
    protected function sumTotalAmount($sales)
    {
        $amount = $sales->map(function ($sale) {
            return $sale->total;
        })->sum();

        return $amount;
    }

    /**
     * return all months of the year that has at least one sale
     */
    protected function getAllMonths($year)
    {
        $months_array = [];

        $sales_dates = Sale::whereYear('created_at', $year)
            ->orderBy('created_at', 'ASC')
            ->pluck('created_at');

        $sales_dates = json_decode($sales_dates);

        if (! empty($sales_dates) ) {
            foreach ($sales_dates as $unformatted_date) {
                $date = new \DateTime( $unformatted_date );
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $months_array[ $month_no ] = $month_name;
            }
        }

        return $months_array;
    }
}
