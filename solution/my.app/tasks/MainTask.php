<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

class MainTask extends \Phalcon\CLI\Task 
{
	public function mainAction() {

		$modelPath = APPLICATION_PATH . "models/";

		$tableSQL = "SELECT SCHEMANAME, TABLENAME FROM pg_catalog.pg_tables WHERE SCHEMANAME = 'public'";
		$tableResult = $this->db->query($tableSQL);
		$tableResult->setFetchMode(Phalcon\Db::FETCH_ASSOC);
		while ($tableRow = $tableResult->fetch() ) 
		{
			$tableName = $tableRow["tablename"];

			$fileName = $tableName;
			$fileName = ucwords(str_replace("_", " ", $fileName));
			$fileName = str_replace(" ", "", $fileName);

			$columnSQL = "SELECT COLUMN_NAME, DATA_TYPE FROM information_schema.columns WHERE table_schema = 'public' AND table_name = '{$tableName}'";
			$columnResult = $this->db->query($columnSQL);
			$columnResult->setFetchMode(Phalcon\Db::FETCH_ASSOC);

			$columns = "";
			while ($columnRow = $columnResult->fetch() ) 
			{
				$columnName = $columnRow["column_name"];

				$columns .= <<<EOF
    public \${$columnName};

EOF;

			}

			$modelFile = fopen("{$modelPath}{$fileName}.php", "w") or die("Unable to open file!");
			
			$model = <<<EOF
<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

class {$fileName} extends \Phalcon\Mvc\Model
{

{$columns}

    public function initialize()
    {
    }

    public function beforeCreate()
    {
        //Set the creation date
        \$this->eklenme_tarihi = date('Y-m-d H:i:s');
    }

    public function beforeUpdate()
    {
        //Set the modification date
        \$this->son_guncelleme_tarihi = date('Y-m-d H:i:s');
    }

 	public function beforeDelete()
    {
        //Set the delete date
        \$this->silindi_mi = 't';
        \$this->silinme_tarihi = date('Y-m-d H:i:s');

        return false;
    }
}

EOF;
			fwrite($modelFile, $model);
			fclose($modelFile);
		}

		die;
	}
}