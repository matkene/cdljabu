<?php

namespace App\Imports;

use App\Models\Course;

use App\Models\Employment;
use App\Models\Result;
//use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;


//use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Row;
//use Maatwebsite\Excel\Concerns\WithBatchInserts;
//use Maatwebsite\Excel\Concerns\WithChunkReading;

$tempHeading = null;
HeadingRowFormatter::extend('custom', function ($value, $key) use (&$tempHeading) {

    if (!empty($value)) {

        $tempHeading = $value;
    }

    return $key . "-" . $tempHeading;


});

HeadingRowFormatter::default('custom');


class UsersImport implements ToModel, WithHeadingRow

    {
    private $updated_at ;
    private $programme; 
    private $level;
    private  $term;
    private $semester;
    private $status;

    private $created_at ;

    private $crsid;

    public function __construct($crsid,$updated_at,$created_at,$programme, $status, $term, $semester,$level)
    {
        $this->crsid = $crsid;
        $this->updated_at  = $updated_at ;
        $this->created_at  = $created_at ;
        $this->programme = $programme;
        $this->status = $status;
        $this->term = $term;
        $this->semester = $semester;
        $this->level = $level;        

    }
     
    /*
   public function model(array $row)
   {
    dd($row);
    return new Result([
                    'matric' => $row[0],
                    'grade_ids' => $row[4],
                    'ca_score' => $this->status,
                    'mark_score' => $this->status,
                    'mark_total' => $this->status,
                    //'grade_ids' => $ca_score + $exam_score,
                    //'ca_score' => $ca_score,
                    //'mark_score' => $exam_score,
                    //'mark_total' => $request->input('mark_total'),
                    'status' => $this->status,
                    'programme_id' => $this->programme,
                    //'school_id' => $request->input('school_id'),
                    'level' => $this->level,
                    'semester' => $this->semester,
                     'semester_id' => $this->semester,
                     'term_id' => $this->term,
                    'others' => $this->status,
                    'crsid' => $row[4],
                    'course_id' =>$this->status,
                    //'course_id' => @$crsid_id[0]['id'],                    
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at,        
       
    ]);
       
    

    } 

    */
    private $firstRow = [];

    /*

    public function onRow(Row $row)
    {
        dd($row);
        $rowIndex = $row->getIndex();
        //dd($rowIndex);
        $row = $row->toArray();
        //dd($row);

        if ($rowIndex == 2) {

            $this->firstRow = $row;

            //dd($this->firstRow);

        } else {

            $result = collect($row)->transform(function ($value, $key) {

                                       
                $columnName = $this->firstRow[$key]; 
                dd($key, $value);               
                $group = explode("-", $key)[1];
                 dd($key, $value, $group,$columnName); 

                return [
                    'group' => $group,
                    'matric' => $columnName,
                    'crsid' => $key
                ];
            })->values()->toArray();

            dump(array_values($result));

            echo "<br>****************Start of Row***************<br>";
        dd($result);
            echo "<br>****************End of Row***************<br>";

            Result::insert($result);


        }

    }
       */ 

    public function model(array $row)
   {

   }
    
   
    public function startRow(): int
    {
        return 2;
    }
        
}

