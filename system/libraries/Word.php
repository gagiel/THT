<?php
class word
{
    function start()
    {
        ob_start();
        echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:w="urn:schemas-microsoft-com:office:word"
        xmlns="http://www.w3.org/TR/REC-html40">';
    }
    function save($path)
    {

        echo "</html>";
        $data = ob_get_contents();
        echo $data;
        ob_end_clean();
        return $this->wirtefile ($path,$data);
    }

    function wirtefile ($fn,$data)
    {
        $fp=fopen($fn,"wb");
        $status = fwrite($fp,$data);
        fclose($fp);
        return $status;
    }
}
?>