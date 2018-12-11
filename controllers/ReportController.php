<?php
namespace app\controllers;

// use PhpOffice\PhpSpreadsheet\Exception;
use app\models\Cuser;
use PHPExcel;
use PHPExcel_IOFactory;
use yii;
use yii\web\Controller;

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\IOFactory;
require_once dirname(__DIR__) . '/vendor/phpoffice/phpexcel/Classes/PHPExcel.php';


class ReportController extends Controller
{
    protected static $COLUMNS = ['username', 'has_agreement', 'first_name', 'cuser_status', 'created_at',
        'updated_at', 'commuter', 'email', 'lat', 'lng', 'address_realtime', 'id'];

    public function actionUsersAgreed()
    {
        $users_agreed = Cuser::find()->select($this::$COLUMNS)->where(['has_agreement' => 1])->asArray()->all();
        // Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setTitle("Carpoolnow All Users Agreed Incentive");

		// Add header
		$objPHPExcel->getActiveSheet()->fromArray($this::$COLUMNS, NULL, 'A1');
		
		$row = 2;
		foreach ($users_agreed as $user_agreed){
			$objPHPExcel->getActiveSheet()->fromArray($user_agreed, NULL, 'A' . $row);
			$row ++;
		}

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Excel2007)
		$date_str = (new \DateTime())->format('Ymd');
		$filename = 'users_agreed' . $date_str . '.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'. $filename .'"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');

        return true;
    }
	
	public function actionUsersLoggedIn()
    {
		$num_year = 50;
        // $users_agreed = Cuser::find()->select($this::$COLUMNS)->where('"updated_at" >= DATE_SUB(NOW(), INTERVAL '. $num_year .' YEAR)')->asArray()->all();
        $users_agreed = Cuser::find()->select($this::$COLUMNS);
        if (isset(\Yii::$app->params['IS_ORACLE']) && \Yii::$app->params['IS_ORACLE']){
            $users_agreed = $users_agreed->where('"updated_at" >= (SYSDATE - INTERVAL \'' . $num_year . '\' YEAR)');
        }
        if (isset(\Yii::$app->params['IS_PG']) && \Yii::$app->params['IS_PG']){
            $users_agreed = $users_agreed->where('"updated_at" >= (current_date - INTERVAL \''. $num_year . 'year\')');
        }
        $users_agreed = $users_agreed->asArray()->all();
        // Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setTitle("Carpoolnow All Users Agreed Incentive");

		// Add header
		$objPHPExcel->getActiveSheet()->fromArray($this::$COLUMNS, NULL, 'A1');
		if (count($users_agreed) === 0){
		    return [];
        }
		$row = 2;
		foreach ($users_agreed as $user_agreed){
			$objPHPExcel->getActiveSheet()->fromArray($user_agreed, NULL, 'A' . $row);
			$row ++;
		}

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		$date_str = (new \DateTime())->format('Ymd');
		$filename = 'users_logged_in' . $date_str . '.xlsx';

		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');

        return true;
    }
	
    public function actionUsersAgreed56()
    {
        $users_agreed = Cuser::find()->select($this::$COLUMNS)->where(['has_agreement' => 1])->asArray()->all();
        $spreadsheet = new Spreadsheet();
        try {
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->fromArray($this::$COLUMNS, '', 'A1');
            $row = 2;
            foreach ($users_agreed as $user_agreed) {
                $sheet->fromArray($users_agreed, '', 'A' . $row);
                $row++;
            }

            $writer = new Xlsx($spreadsheet);
            $date_str = (new \DateTime())->format('Ymd');
            $filename = 'users_agreed' . $date_str . '.xlsx';
            $writer->save('tmp/' . $filename);
// Redirect output to a client’s web browser (Xlsx)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        } catch (Exception $exception) {
            Yii::error($exception);
        }

        return $users_agreed;
    }

    public function afterAction($action, $result)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/json');
        return parent::afterAction($action, $result);
    }
}