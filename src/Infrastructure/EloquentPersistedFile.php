<?php

namespace Reshadman\FileSecretary\Infrastructure;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Reshadman\FileSecretary\Domain\PersistableFile;
use Reshadman\FileSecretary\Domain\PersistableFileTrait;

class EloquentPersistedFile extends Model implements PersistableFile
{
    use PersistableFileTrait;

    /**
     * EloquentPersistedFile constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        if ($this->table === null) {
            $this->table = config('file_secretary.eloquent.table_name');
        }

        parent::__construct($attributes);
    }

    /**
     * The unique identifier think of it as PK
     *
     * @return string
     */
    public function getFileableIdentifier()
    {
        return $this['id'];
    }

    /**
     * Uuid of the file. Exposed to users, as we should not expose PK's or any type of ids to the user
     * event if they are not incremental (They are uuid themselves).
     *
     * @return string
     */
    public function getFileableUuid()
    {
        return $this['uuid'];
    }

    /**
     * Creation time of the file
     *
     * @return Carbon
     */
    public function getFileableCreatedAt()
    {
        return $this['created_at'];
    }

    /**
     * The time file has been updated.
     *
     * @return Carbon
     */
    public function getFileableUpdated()
    {
        return $this['updated_at'];
    }

    /**
     * One of your defined contexts in the config file.
     *
     * @return string
     */
    public function getFileableContext()
    {
        return $this['context'];
    }

    /**
     * Client's given file name.
     *
     * @return string
     */
    public function getFileableOriginalName()
    {
        return $this['original_name'];
    }

    /**
     * Our file name.
     *
     * @return string
     */
    public function getFileableFileName()
    {
        return $this['file_name'];
    }

    /**
     * Used when there are non tracked siblings are added to the file entity (Like resized images), This folder is
     * a unique folder that allows us to perform batch actions on the folder.
     *
     * @return string
     */
    public function getFileableSiblingFolder()
    {
        return $this['sibling_folder'];
    }

    /**
     * Using the same container for all of your application contexts? By defining context for each of them
     * you can control the behaviour of the each category (For example your file manager images are not resized if you need the resize functionality)
     * for something else.
     *
     * @return string
     */
    public function getFileableContextFolder()
    {
        return $this['context_folder'];
    }

    /**
     * Get fileable hash. Is used for detecting repeated files.
     *
     * @return string
     */
    public function getFileableHash()
    {
        return $this['hash'];
    }

    /**
     * Ensures that the the two files are really equal by using an additional hash.
     *
     * @return string
     */
    public function getFileableEnsuredHash()
    {
        return $this['ensured_hash'];
    }
}