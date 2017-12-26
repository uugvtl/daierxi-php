<?php
namespace App\Libraries\Caches\Dependencies;
use Phalcon\Exception;
/**
 * CFileCacheDependency represents a dependency based on a file's last modification time.
 *
 * CFileCacheDependency performs dependency checking based on the
 * last modification time of the file specified via {@link fileName}.
 * The dependency is reported as unchanged if and only if the file's
 * last modification time remains unchanged.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.caching.dependencies
 * @since 1.0
 */
class FileCacheDependency extends BaseCacheDependency
{

    /**
     * Constructor.
     * @param string $fileName name of the file whose change is to be checked.
     */
    public function __construct($fileName=null)
    {
        $this->key=$fileName;
    }

    /**
     * Generates the data needed to determine if dependency has been changed.
     * This method returns the file's last modification time.
     * @throws Exception if {@link fileName} is empty
     * @return mixed the data needed to determine if dependency has been changed.
     */
    protected function generateDependentData()
    {
        if(is_file($this->key))
            return file_get_contents($this->key);
        else
            throw new Exception('App\Libraries\Caches\Dependencies\FileCacheDependency.fileName cannot be empty.');
    }
}
