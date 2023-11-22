<?php

//Get Model Path
namespace App\Models\DCS\MYSQL\View;

//Get Auth
use Auth;

//Get User Authenticatable
use Illuminate\Database\Eloquent\Model;

//Get Database
use DB;

//Get Class
class Report extends Model{


  public function getAnnualTotalBooked($data = null){

    //Get Query
    $result = DB::connection($this->connection);

    //Get Result
    $result = $result->select(
      '
      SELECT
          months.n AS months,
          COALESCE(COUNT(MONTH(booking_payment.created_at)), 0) AS total
      FROM (
          SELECT 1 AS n UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION
          SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION
          SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
      ) AS months
      LEFT JOIN booking_payment ON MONTH(booking_payment.created_at) = months.n AND YEAR(booking_payment.created_at) = 2023
      GROUP BY months.n
      ORDER BY months;
      '
    );

    //Return Result
    return $result;

  }

  public function getAnnualTotalPrice($data = null){

    //Get Query
    $result = DB::connection($this->connection);

    //Get Result
    $result = $result->select(
      '
      SELECT
          months.n AS months,
          COALESCE(SUM(booking_payment.price), 0) AS total_price
      FROM (
          SELECT 1 AS n UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION
          SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION
          SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
      ) AS months
      LEFT JOIN booking_payment ON MONTH(booking_payment.created_at) = months.n AND YEAR(booking_payment.created_at) = 2023
      GROUP BY months.n
      ORDER BY months;
      '
    );

    //Return Result
    return $result;

  }

}
