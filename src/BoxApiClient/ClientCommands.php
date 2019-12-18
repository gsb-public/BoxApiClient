<?php

namespace BoxApiClient;

class ClientCommands
{

  public static function getCommands()
  {
    return array(
      'name' => 'Box.com',
      'apiVersion' => '2.0',
      //  'baseUrl' => 'https://api.box.com/2.0/',
      'description' => 'Box.com is a cloud file storage service',
      'operations' => array(
        'SearchFolder' => array(
          'description' => 'Searches for items that are available to the user or an entire enterprise.',
          'httpMethod' => 'GET',
          'uri' => 'https://api.box.com/2.0/search',
          'parameters' => array(
            'ancestor_folder_ids' => array(
              'description' => 'Search results will also include items within subfolders.',
              'location' => 'query',
              'type' => 'string',
            ),
            'fields' => array(
              'description' => 'A comma-separated list of attributes to include in the response. This can be used to request fields that are not normally returned in a standard response.',
              'location' => 'query',
              'type' => 'array',
            ),
            'type' => array(
              'description' => 'Limits search results to items of this type.',
              'location' => 'query',
              'type' => 'string',
            ),
            'file_extensions' => array(
              'description' => 'Limits search results to a comma-separated list of file extensions.',
              'location' => 'query',
              'type' => 'string',
            ),
            'mdfilters' => array(
              'description' => 'Limits search results to items that match the metadata template name and content.',
              'location' => 'query',
              'type' => 'string',
            ),
            'limit' => array(
              'description' => 'The number of items to return.',
              'location' => 'query',
              'type' => 'integer',
            ),
            'offset' => array(
              'description' => 'The item at which to begin the response.',
              'location' => 'query',
              'type' => 'integer',
            ),
          ),
        ),
        'GetFolderItems' => array(
          'description' => 'Retrieves the files and/or folders contained within this folder without any other metadata about the folder.',
          'httpMethod' => 'GET',
          'uri' => 'https://api.box.com/2.0/folders/{id}/items',
          'parameters' => array(
            'id' => array(
              'description' => 'The ID of the folder to be retrieved',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
            'fields' => array(
              'description' => 'Attribute(s) to include in the response',
              'location' => 'query',
              'type' => 'string',
            ),
            'limit' => array(
              'description' => 'The number of items to return',
              'location' => 'query',
              'type' => 'integer',
            ),
            'offset' => array(
              'description' => 'The item at which to begin the response',
              'location' => 'query',
              'type' => 'integer',
            ),
          ),
        ),
        'CreateFolder' => array(
          'description' => 'Used to create a new empty folder. The new folder will be created inside of the specified parent folder.',
          'httpMethod' => 'POST',
          'uri' => 'https://api.box.com/2.0/folders',
          'parameters' => array(
            'name' => array(
              'description' => 'The desired name for the folder',
              'location' => 'json',
              'type' => 'string',
              'required' => true,
            ),
            'parent' => array(
              'description' => 'The parent folder',
              'location' => 'json',
              'type' => 'object',
              'properties' => array(
                'id' => array(
                  'description' => 'The ID of the parent folder',
                  'location' => 'json',
                  'type' => 'string',
                  'required' => true,
                ),
              ),
            ),
          ),
        ),
        'GetFolder' => array(
          'description' => 'Retrieves the full metadata about a folder, including information about when it was last updated as well as the files and folders contained in it.',
          'httpMethod' => 'GET',
          'uri' => 'https://api.box.com/2.0/folders/{id}',
          'parameters' => array(
            'id' => array(
              'description' => 'The ID of the folder to be retrieved',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
          ),
        ),
        'CopyFolder' => array(
          'description' => 'Used to create a copy of a folder in another folder. The original version of the folder will not be altered.',
          'httpMethod' => 'POST',
          'uri' => 'https://api.box.com/2.0/folders/{id}/copy',
          'parameters' => array(
            'id' => array(
              'description' => 'The ID of the folder to be copied',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
            'name' => array(
              'description' => 'An optional new name for the folder',
              'location' => 'json',
              'type' => 'string',
            ),
            'parent' => array(
              'description' => 'Object representing the new location of the folder',
              'location' => 'json',
              'type' => 'object',
              'properties' => array(
                'id' => array(
                  'description' => 'The ID of the destination folder',
                  'location' => 'json',
                  'type' => 'string',
                  'required' => true,
                ),
              ),
            ),
          ),
        ),
        'DeleteFolder' => array(
          'description' => 'Used to delete a folder.',
          'httpMethod' => 'DELETE',
          'uri' => 'https://api.box.com/2.0/folders/{id}',
          'parameters' => array(
            'id' => array(
              'description' => 'The ID of the folder to be deleted',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
            'if-match' => array(
              'description' => 'This is in the "etag" field of the folder object.',
              'location' => 'header',
              'type' => 'string',
              'sentAs' => 'If-Match'
            ),
            'recursive' => array(
              'description' => 'Whether to delete this folder if it has items inside of it',
              'location' => 'query',
              'type' => 'string',
            ),
          ),
        ),
        'UpdateFolder' => array(
          'description' => 'Used to update information about the folder.',
          'httpMethod' => 'PUT',
          'uri' => 'https://api.box.com/2.0/folders/{id}',
          'parameters' => array(
            'id' => array(
              'description' => 'The ID of the folder to be updated',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
            'if-match' => array(
              'description' => 'This is in the "etag" field of the folder object.',
              'location' => 'header',
              'type' => 'string',
              'sentAs' => 'If-Match'
            ),
            'name' => array(
              'description' => 'The name of the folder',
              'location' => 'json',
              'type' => 'string',
            ),
            'description' => array(
              'description' => 'The description of the folder',
              'location' => 'json',
              'type' => 'string',
            ),
            'parent' => array(
              'description' => 'The parent folder',
              'location' => 'json',
              'type' => 'object',
              'properties' => array(
                'id' => array(
                  'description' => 'The ID of the parent folder',
                  'location' => 'json',
                  'type' => 'string',
                ),
              ),
            ),
            'shared_link' => array(
              'description' => 'An object representing this item\'s shared link and associated permissions',
              'location' => 'json',
              'type' => 'object',
              'properties' => array(
                'access' => array(
                  'description' => "The level of access required for this shared link. Can be 'open', 'company', 'collaborators'",
                  'location' => 'json',
                  'type' => 'string',
                ),
                'unshared_at' => array(
                  'description' => 'The day that this link should be disabled at. Timestamps are rounded off to the given day.',
                  'location' => 'json',
                  'type' => 'string',
                ),
                'permissions' => array(
                  'description' => 'The set of permissions that apply to this link',
                  'location' => 'json',
                  'type' => 'object',
                  'properties' => array(
                    'can_download' => array(
                      'description' => 'Whether this link allows downloads',
                      'location' => 'json',
                      'type' => 'boolean'
                    ),
                    'can_preview' => array(
                      'description' => 'Whether this link allows previews',
                      'location' => 'json',
                      'type' => 'boolean'
                    ),
                  ),
                ),
              ),
            ),
            'folder_upload_email' => array(
              'description' => 'The email-to-upload address for this folder',
              'location' => 'json',
              'type' => 'object',
              'properties' => array(
                'access' => array(
                  'description' => "Can be 'open' or 'collaborators'",
                  'location' => 'json',
                  'type' => 'string',
                ),
              ),
            ),
            'owned_by' => array(
              'description' => 'The user who owns the folder.',
              'location' => 'json',
              'type' => 'object',
              'properties' => array(
                'id' => array(
                  'description' => 'The ID of the user, should be your own user ID.',
                  'location' => 'json',
                  'type' => 'string',
                ),
              ),
            ),
          ),
        ),
        'GetFolderDiscussions' => array(
          'description' => 'Retrieves the discussions on a particular folder, if any exist.',
          'httpMethod' => 'GET',
          'uri' => 'https://api.box.com/2.0/folders/{id}/discussions',
          'parameters' => array(
            'id' => array(
              'description' => 'The ID of the folder to be retrieved',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
          ),
        ),
        'GetFolderCollaborations' => array(
          'description' => 'Use this to get a list of all the collaborations on a folder i.e. all of the users that have access to that folder.',
          'httpMethod' => 'GET',
          'uri' => 'https://api.box.com/2.0/folders/{id}/collaborations',
          'parameters' => array(
            'id' => array(
              'description' => 'The ID of the folder to be retrieved',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
          ),
        ),
        'GetTrashItems' => array(
          'description' => 'Retrieves the files and/or folders that have been moved to the trash.',
          'httpMethod' => 'GET',
          'uri' => 'https://api.box.com/2.0/folders/trash/items',
          'parameters' => array(
            'fields' => array(
              'description' => 'Attribute(s) to include in the response',
              'location' => 'query',
              'type' => 'string',
            ),
            'limit' => array(
              'description' => 'The number of items to return',
              'location' => 'query',
              'type' => 'integer',
            ),
            'offset' => array(
              'description' => 'The item at which to begin the response',
              'location' => 'query',
              'type' => 'integer',
            ),
          ),
        ),
        'GetTrashedFolder' => array(
          'description' => 'Retrieves an item that has been moved to the trash.',
          'httpMethod' => 'GET',
          'uri' => 'https://api.box.com/2.0/folders/{id}/trash',
          'parameters' => array(
            'id' => array(
              'description' => 'The ID of the folder to be retrieved',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
          ),
        ),
        'DeleteTrashedFolder' => array(
          'description' => 'Permanently deletes an item that is in the trash. The item will no longer exist in Box. This action cannot be undone.',
          'httpMethod' => 'POST',
          'uri' => 'https://api.box.com/2.0/folders/{id}',
          'parameters' => array(
            'id' => array(
              'description' => 'The ID of the folder to be retrieved',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
          ),
        ),
        'RestoreTrashedFolder' => array(
          'description' => 'Restores an item that has been moved to the trash.',
          'httpMethod' => 'DELETE',
          'uri' => 'https://api.box.com/2.0/folders/{id}',
          'parameters' => array(
            'id' => array(
              'description' => 'The ID of the folder to be retrieved',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
            'name' => array(
              'description' => 'The desired name for the folder',
              'location' => 'json',
              'type' => 'string',
              'required' => true,
            ),
            'parent' => array(
              'description' => 'The parent folder',
              'location' => 'json',
              'type' => 'object',
              'properties' => array(
                'id' => array(
                  'description' => 'The ID of the parent folder',
                  'location' => 'json',
                  'type' => 'string',
                  'required' => true,
                ),
              ),
            ),
          ),
        ),

        // Files
        'GetFile' => array(
          'description' => 'Used to retrieve the metadata about a file.',
          'httpMethod' => 'GET',
          'uri' => 'https://api.box.com/2.0/files/{id}',
          'parameters' => array(
            'id' => array(
              'description' => 'The ID of the file to be retrieved',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
            'fields' => array(
              'description' => 'Attribute(s) to include in the response',
              'location' => 'query',
              'type' => 'string',
            ),
          ),
        ),
        'UpdateFile' => array(
          'description' => 'Used to update individual or multiple fields in the file object, including renaming the file, changing it\'s description, and creating a shared link for the file.',
          'httpMethod' => 'PUT',
          'uri' => 'https://api.box.com/2.0/files/{id}',
          'parameters' => array(
            'id' => array(
              'description' => 'The ID of the file to be updated',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
            'if-match' => array(
              'description' => 'This is in the "etag" field of the file object.',
              'location' => 'header',
              'type' => 'string',
              'sentAs' => 'If-Match'
            ),
            'name' => array(
              'description' => 'The new name of the file',
              'location' => 'json',
              'type' => 'string',
            ),
            'description' => array(
              'description' => 'The new description of the file',
              'location' => 'json',
              'type' => 'string',
            ),
            'parent' => array(
              'description' => 'The parent folder',
              'location' => 'json',
              'type' => 'object',
              'properties' => array(
                'id' => array(
                  'description' => 'The ID of the parent folder',
                  'location' => 'json',
                  'type' => 'string',
                ),
              ),
            ),
            'shared_link' => array(
              'description' => 'An object representing this item\'s shared link and associated permissions',
              'location' => 'json',
              'type' => 'object',
              'properties' => array(
                'access' => array(
                  'description' => "The level of access required for this shared link. Can be 'open', 'company', 'collaborators'",
                  'location' => 'json',
                  'type' => 'string',
                ),
                'unshared_at' => array(
                  'description' => 'The day that this link should be disabled at. Timestamps are rounded off to the given day.',
                  'location' => 'json',
                  'type' => 'string',
                ),
                'permissions' => array(
                  'description' => 'The set of permissions that apply to this link',
                  'location' => 'json',
                  'type' => 'object',
                  'properties' => array(
                    'can_download' => array(
                      'description' => 'Whether this link allows downloads',
                      'location' => 'json',
                      'type' => 'boolean'
                    ),
                    'can_preview' => array(
                      'description' => 'Whether this link allows previews',
                      'location' => 'json',
                      'type' => 'boolean'
                    ),
                  ),
                ),
              ),
            ),
          ),
        ),
        'DownloadFile' => array(
          'description' => 'Retrieves the actual data of the file.',
          'httpMethod' => 'GET',
          'uri' => 'https://api.box.com/2.0/files/{id}/content',
          'parameters' => array(
            'id' => array(
              'description' => 'The ID of the file to be retrieved',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
            'version' => array(
              'description' => 'The ID specific version of this file to download.',
              'location' => 'query',
              'type' => 'string',
            ),
          ),
        ),
        'UploadFile' => array(
          'description' => 'Use the Uploads API to allow users to add a new file.',
          'httpMethod' => 'POST',
          'uri' => 'https://upload.box.com/api/2.0/files/content',
          'parameters' => array(
            'attributes' => array(
              'description' => 'A JSON formatted set of file-attributes that includes: name, parent, content_created_at, content_modified_at.',
              'location' => 'postField',
              'type' => 'string',
              'required' => true,
            ),
            'file' => array(
              'description' => 'The file to be uploaded.',
              'location' => 'postFile',
              'type' => 'any',
              'required' => true,
            ),
          ),
        ),
        'DeleteFile' => array(
          'description' => 'Used to delete a file.',
          'httpMethod' => 'DELETE',
          'uri' => 'https://api.box.com/2.0/files/{id}',
          'parameters' => array(
            'id' => array(
              'description' => 'The ID of the folder to be deleted.',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
            'if-match' => array(
              'description' => 'This is in the "etag" field of the file object.',
              'location' => 'header',
              'type' => 'string',
              'sentAs' => 'If-Match'
            ),
          ),
        ),

        // Shared items
        'GetSharedItem' => array(
          'description' => 'Used to get information about a sharing link.',
          'httpMethod' => 'GET',
          'uri' => 'https://api.box.com/2.0/shared_items',
          'parameters' => array(
            'shared_link' => array(
              'description' => 'Sharing link.',
              'location' => 'header',
              'type' => 'string',
              'sentAs' => 'BoxApi',
              'required' => true,
            ),
            'fields' => array(
              'description' => 'Attribute(s) to include in the response',
              'location' => 'query',
              'type' => 'string',
            ),
          ),
        ),

        // Comments.
        'GetFileComments' => array(
          'description' => 'Retrieves the comments on a particular file, if any exist.',
          'httpMethod' => 'GET',
          'uri' => 'https://api.box.com/2.0/files/{id}/comments',
          'parameters' => array(
            'id' => array(
              'description' => 'The ID of the folder.',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
            'limit' => array(
              'description' => 'Limit number of items returned.',
              'location' => 'query',
              'type' => 'string',
              'required' => false,
            ),
            'offset' => array(
              'description' => 'Offset, zero based.',
              'location' => 'query',
              'type' => 'string',
              'required' => false,
            ),
          ),
        ),

        // METADATA API

        'MetaGetType' => array(
          'description' => 'Used to retrieve the metadata type instance for a corresponding Box file.',
          'httpMethod' => 'GET',
          'uri' => 'https://api.box.com/2.0/files/{id}/metadata/{type}',
          'parameters' => array(
            'id' => array(
              'description' => 'File ID',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
            'type' => array(
              'description' => 'Custom value defined by a user or application.',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
          ),
        ),

        'MetaCreateType' => array(
          'description' => 'Used to create the metadata type instance for a corresponding Box file.',
          'httpMethod' => 'POST',
          'uri' => 'https://api.box.com/2.0/files/{id}/metadata/{type}',
          'parameters' => array(
            'id' => array(
              'description' => 'File ID',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
            'type' => array(
              'description' => 'Custom value defined by a user or application.',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
          ),
          'additionalParameters' => array(
            'location' => 'json',
            'required' => true,
          ),
        ),

        'MetaUpdateType' => array(
          'description' => 'Used to update the metadata type instance for a corresponding Box file.',
          'httpMethod' => 'PUT',
          'uri' => 'https://api.box.com/2.0/files/{id}/metadata/{type}',
          'parameters' => array(
            'content-type' => array(
              'location' => 'header',
              'static' => true,
              'required' => true,
              'default' => 'application/json-patch+json',
              'sentAs' => 'Content-Type',
            ),
            'id' => array(
              'description' => 'File ID',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
            'type' => array(
              'description' => 'Custom value defined by a user or application.',
              'location' => 'uri',
              'type' => 'string',
              'required' => true,
            ),
            'operations' => array(
              'description' => 'Array of operations, JSON encoded.',
              'location' => 'body',
              'required' => true,
              'filters' => array('json_encode'),
            ),
          ),
        ),

      ),
    );
  }
}

