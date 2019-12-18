<?php

namespace BoxApiClient;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use Psr\Http\Message\RequestInterface;

$loader = new \Composer\Autoload\ClassLoader();
$loader->add('BoxApiClient', __DIR__);

function add_header($header, $value)
{
  return function (callable $handler) use ($header, $value) {
    return function (
      RequestInterface $request,
      array $options
    ) use ($handler, $header, $value) {
      $request = $request->withHeader($header, $value);
      return $handler($request, $options);
    };
  };
}

/**
 * My example web service client
 */
class BoxApiClient extends Client
{
    private $description = null;

    /**
     * Factory method to create a new Client
     * @return self
     */
    public static function factory($config = array())
    {
        $config['allow_redirects'] = false;

        $stack = new HandlerStack();
        $stack->setHandler(new CurlHandler());
        $stack->push(add_header('Authorization', 'Bearer ' . $config['token']));
        $stack->push(add_header('Accept', 'application/json'));
        $config['handler'] = $stack;

        $config['description'] = ClientCommands::getCommands();

        $client = new self($config);

        return $client;
    }

    public function getGuzzleClient() {
      $config = $this->getConfig();
      $guzzleClient = new GuzzleClient($this, new Description($config['description']), null, new ResponseTransformer());
      return $guzzleClient;
    }

  /**
   * Searches for items that are available to the user or an entire enterprise.
   *
   * @param integer $id The folder ID.
   * @param string $fields A comma-separated list of attributes to include in the response.
   * @param string $type Limits search results to items of this type.
   * @param stirng $fileExtensions Limits search results to a comma-separated list of file extensions.
   * @param string (array) $mdfilters 'Limits search results to items that match the metadata template name and content.
   * @param integer $limit The number of items to return.
   * @param integer $offset The item at which to begin the response.
   * @return array|mixed
   */
  public function searchFolder($id, $fields = NULL, $type, $fileExtensions, $mdfilters, $limit = 100, $offset = 0)
  {
    $guzzleClient = $this->getGuzzleClient();
    $command = $guzzleClient->getCommand('SearchFolder', array(
      'ancestor_folder_ids' => $id,
      'type' => $type,
      'fields' => $fields,
      'file_extensions' => $fileExtensions,
      'mdfilters' => $mdfilters,
      'limit' => $limit,
      'offset' => $offset
    ));
    return $guzzleClient->execute($command);
  }

    /**
     * Get information about a folder's items.
     *
     * @param integer $id The folder ID.
     * @param $fields A comma-separated list of attributes to include in the response.
     * @param integer $limit The number of items to return.
     * @param integer $offset The item at which to begin the response.
     * @return array|mixed
     */
    public function getFolderItems($id, $fields = NULL, $limit = 100, $offset = 0)
    {
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->getCommand('GetFolderItems', array('id' => $id, 'fields' => $fields, 'limit' => $limit, 'offset' => $offset));
        return $guzzleClient->execute($command);
    }

    /**
     * Create a new folder.
     *
     * @param string $name The folder name
     * @param string $parent_id The parent folder's ID.
     * @return array|mixed
     */
    public function createFolder($name, $parent_id)
    {
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->getCommand('CreateFolder', array('parent' => array('id' => $parent_id), 'name' => $name));
        return $guzzleClient->execute($command);
    }

    /**
     * Get information about a folder.
     *
     * @param integer $id The folder ID.
     * @return array|mixed
     */
    public function getFolder($id)
    {
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->guzzleClient->getCommand('GetFolder', array('id' => $id));
        return $guzzleClient->execute($command);
    }

    /**
     * Copy a folder.
     *
     * @param string $id The ID of the folder to be copied.
     * @param string $parent_id The ID of the destination's parent.
     * @param string $name Optional name of new folder.
     * @return array|mixed
     */
    public function copyFolder($id, $parent_id, $name = NULL)
    {
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->getCommand('CopyFolder', array('id' => $id, 'parent' => array('id' => $parent_id), 'name' => $name));
        return $guzzleClient->execute($command);
    }

    /**
     * Delete a folder.
     *
     * @param string $id The ID of the folder to be deleted.
     * @param boolean $recursive Whether or not to recursively delete files.
     * @param string $etag Optional etag to send in if-match header.
     * @return array|mixed
     */
    public function deleteFolder($id, $recursive = FALSE, $etag = NULL)
    {
        $params = array('id' => $id,  'if-match' => $etag);
        $params['recursive'] = $recursive ? 'true' : NULL;
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->getCommand('DeleteFolder', $params);
        return $guzzleClient->execute($command);
    }

    /**
     * Updates a folder.
     *
     * @param string $id The ID of the folder to be deleted.
     * @param array $params Parameters to set on the new folder
     * @param string $etag Optional etag to send in if-match header.
     * @return array|mixed
     */
    public function updateFolder($id, $params = array(), $etag = NULL)
    {
        $params['id'] = $id;
        $params['if-match'] = $etag;
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->getCommand('UpdateFolder', $params);
        return $guzzleClient->execute($command);
    }

    /**
     * Get a folder's discussions.
     *
     * @param integer $id The folder ID.
     * @return array|mixed
     */
    public function getFolderDiscussions($id)
    {
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->getCommand('GetFolderDiscussions', array('id' => $id));
        return $guzzleClient->execute($command);
    }

    /**
     * Get a folder's collaborations.
     *
     * @param integer $id The folder ID.
     * @return array|mixed
     */
    public function getFolderCollaborations($id)
    {
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->getCommand('GetFolderCollaborations', array('id' => $id));
        return $guzzleClient->execute($command);
    }

    /**
     * Get a folder's collaborations.
     *
     * @return array|mixed
     */
    public function getTrashItems($fields = NULL, $limit = 100, $offset = 0)
    {
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->getCommand('GetTrashItems', array('fields' => $fields, 'limit' => $limit, 'offset' => $offset));
        return $guzzleClient->execute($command);
    }

    /**
     * Get a folder's discussions.
     *
     * @param integer $id The folder ID.
     * @return array|mixed
     */
    public function deleteTrashedFolder($id)
    {
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->getCommand('DeleteTrashedFolder', array('id' => $id));
        return $guzzleClient->execute($command);
    }

    // @TODO Restore trashed folder

    /**
     * Get a file's metadata.
     *
     * @param integer $id The file ID.
     * @return array|mixed
     */
    public function getFile($id, $fields = NULL)
    {
        $params['id'] = $id;
        if ($fields) {
            $params['fields'] = $fields;
        }
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->getCommand('GetFile', $params);
        return $guzzleClient->execute($command);
    }

    // @TODO Update file

    /**
     * Get a file's metadata.
     *
     * @param integer $id The file ID.
     * @return array|mixed
     */
    public function downloadFile($id, $version = NULL)
    {
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->getCommand('DownloadFile', array('id' => $id, 'version' => $version));
        return $guzzleClient->execute($command);
    }

    /**
     * Upload a file.
     *
     * @param string $filename The name of the file to be uploaded.
     * @param string $parent_id The ID of the parent folder.
     * @param string $filepath The path to the file to be uploaded.
     * @return array|mixed
     */
    public function uploadFile($filename, $parent_id, $filepath)
    {
        $params =  json_encode(array('name' => $filename, 'parent' => array('id' => $parent_id)));
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->getCommand('UploadFile', array('attributes' => $params, 'file' => $filepath));
        return $guzzleClient->execute($command);
    }

    /**
     * Delete a file.
     *
     * @param integer $id The file ID.
     * @param string $etag Optional etag to send in if-match header.
     * @return array|mixed
     */
    public function deleteFile($id, $etag = NULL)
    {
        $params = array('id' => $id,  'if-match' => $etag);
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->getCommand('DeleteFile', $params);
        return $guzzleClient->execute($command);
    }

    /**
     * Comments on a file.
     *
     * @param integer $id The file ID.
     * @param integer $limit Defines the maximum number of records that will be returned on a page.
     * @param integer $offset Offset is zero based.
     * @return array|mixed
     */
    public function getFileComments($id, $limit = NULL, $offset = NULL)
    {
        $params = array('id' => $id);
        if ($limit) {
          $params['limit'] = $limit;
        }
        if ($offset) {
          $params['offset'] = $offset;
        }
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->getCommand('GetFileComments', $params);
        return $guzzleClient->execute($command);
    }

    /**
     * Used to retrieve the metadata about a shared item when only given a shared link.
     * Because of varying permission levels for shared links, a password may be required
     * to retrieve the shared item.
     *
     * @param string $shared_link The shared link for this item.
     * @param string $password The password for this shared link.
     * @param string|array $fields A string of comma separated fields, or an array of individual fields..
     * @return array|mixed
     */
    public function getSharedItem($shared_link, $password = NULL, $fields = NULL)
    {
        $params['shared_link'] = 'shared_link=' . $shared_link;
        if ($password) {
            $params['shared_link'] = '&shared_link_password=' . $password;
        }
        if (!empty($fields)) {
            $fields = is_array($fields) ? implode(',', $fields) : $fields;
            $params['fields'] = $fields;
        }
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->getCommand('GetSharedItem', $params);
        return $guzzleClient->execute($command);
    }

    public function metaGetType($id, $type)
    {
      $guzzleClient = $this->getGuzzleClient();
      $command = $this->getCommand('MetaGetType', array('id' => $id, 'type' => $type));
      return $this->execute($command);
    }

    public function metaCreateType($id, $type, $values)
    {
      $params = array('id' => $id, 'type' => $type);
      $params = $params + $values;
      $guzzleClient = $this->getGuzzleClient();
      $command = $guzzleClient->getCommand('MetaCreateType', $params);
      return $guzzleClient->execute($command);
    }

    public function metaUpdateType($id, $type, $operations)
    {
        $guzzleClient = $this->getGuzzleClient();
        $command = $guzzleClient->getCommand('MetaUpdateType', array('id' => $id, 'type' => $type, 'operations' => $operations));
        return $guzzleClient->execute($command);
    }

}
