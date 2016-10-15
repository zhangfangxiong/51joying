<?php

/**
 * Excel处理相关
 */
class Util_Excel
{

    private $sFile;

    private $oPHPExcel;

    private $oReader;

    private $oSheet;

    private $iRowNum;

    private $iColNum;

    private $iCurrRow;

    private $sType;

    private $aType = array(
        'xls' => 'Excel5',
        'xlsx' => 'Excel2007',
        'csv' => 'Csv'
    );

    public function load ($sFile, $sExt)
    {
        $sExt = strtolower($sExt);
        $sType = isset($this->aType[$sExt]) ? $this->aType[$sExt] : 'Excel5';

        $this->sType = $sType;
        $this->sFile = $sFile;
        if ($sType == 'Csv') {
            $this->oReader = fopen($sFile, "r");
        } else {
            $this->oReader = PHPExcel_IOFactory::createReader($sType);
            $this->oReader->setReadDataOnly(true);
            $this->oPHPExcel = $this->oReader->load($sFile);
            $this->oSheet = $this->oPHPExcel->getActiveSheet();
            $this->iRowNum = $this->oSheet->getHighestRow();
            $sHighestColumn = $this->oSheet->getHighestColumn();
            $this->iColNum = PHPExcel_Cell::columnIndexFromString($sHighestColumn);
        }
        $this->iCurrRow = 1;
    }

    /**
     * 查找Excel的下一行
     *
     * @return array
     */
    public function getNextRow ($aKV = null)
    {
        if ($this->sType == 'Csv') {
            return $this->getCsvNextRow($aKV);
        } else {
            return $this->getExcelNextRow($aKV);
        }
    }

    public function getCsvNextRow ($aKV)
    {
        $aRow = array();
        while (($aData = fgetcsv($this->oReader, 4096, ",")) !== FALSE) {
            $aRow = array();
            $sFind = false;
            for ($iCol = 0; $iCol < count($aData); $iCol ++) {
                $sVal = trim($aData[$iCol]);
                $sVal = Util_Tools::toSCB($sVal);
                $sVal = preg_replace('/\s/', '', $sVal);
                if ($aKV == null) {
                    $aRow[] = $sVal;
                } elseif (isset($aKV[$iCol])) {
                    $aRow[$aKV[$iCol]] = $sVal;
                }
                
                if (! empty($sVal)) {
                    $sFind = true;
                }
            }
            
            if ($sFind) {
                break;
            }
        }
        
        return $aRow;
    }

    public function getExcelNextRow ($aKV)
    {
        $aRow = array();
        for (; $this->iCurrRow <= $this->iRowNum; $this->iCurrRow ++) {
            $aRow = array();
            $sFind = false;
            for ($iCol = 0; $iCol < $this->iColNum; $iCol ++) {
                $sVal = trim($this->oSheet->getCellByColumnAndRow($iCol, $this->iCurrRow)->getValue());
                $sVal = Util_Tools::toSCB($sVal);
                $sVal = preg_replace('/\s/', '', $sVal);
                if ($aKV == null) {
                    $aRow[] = $sVal;
                } elseif (isset($aKV[$iCol])) {
                    $aRow[$aKV[$iCol]] = $sVal;
                }
                
                if (! empty($sVal)) {
                    $sFind = true;
                }
            }
            
            if ($sFind) {
                break;
            }
        }
        
        $this->iCurrRow ++;
        
        return $aRow;
    }

    /**
     * 转换成日期
     * 
     * @param unknown $iDate            
     * @return string
     */
    public static function toDate ($iDate)
    {
        $iDate = $iDate > 25568 ? $iDate + 1 : 25569;
        /* There was a bug if Converting date before 1-1-1970 (tstamp 0) */
        $iOffset = (70 * 365 + 17 + 3) * 86400;
        return date("Y-m-d", ($iDate * 86400) - $iOffset);
    }

    /**
     * 转换成整型
     * 
     * @param unknown $sVal            
     * @return mixed
     */
    public static function toInt ($sVal)
    {
        return (int) preg_replace('@^.*?(\d+).*$@', '$1', $sVal);
    }

    /**
     * 转换成Float
     * 
     * @param unknown $sVal            
     * @return number
     */
    public static function toFloat ($sVal)
    {
        return (int) preg_replace('@^.*?([\d\.]+).*$@', '$1', $sVal);
    }
}