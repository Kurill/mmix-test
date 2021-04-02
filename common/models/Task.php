<?php

namespace common\models;

use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%task}}".
 *
 * @property int $id
 * @property int $project_id
 * @property int $creator_id
 * @property int|null $executor_id
 * @property string $title
 * @property string $description
 * @property string|null $file
 *
 * @property User $creator
 * @property User $executor
 * @property Project $project
 */
class Task extends \yii\db\ActiveRecord
{

    const UPLOAD_PATH = '@frontend/web/uploads';

    const UPLOAD_URL = '/uploads';
    /**
     * @var UploadedFile
     */
    public $uploadFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%task}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'creator_id', 'title', 'description'], 'required'],
            [['project_id', 'creator_id', 'executor_id'], 'integer'],
            [['description'], 'string'],
            [['uploadFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['executor_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'creator_id' => 'Creator ID',
            'executor_id' => 'Executor ID',
            'title' => 'Title',
            'description' => 'Description',
            'uploadFile' => 'File',
            'project.title' => 'Project title',
        ];
    }

    /**
     * Upload file to server
     */
    public function upload()
    {
        $fileName = uniqid() . $this->uploadFile->baseName
            . '.'
            . $this->uploadFile->extension;
        $path = self::UPLOAD_PATH . DIRECTORY_SEPARATOR . $fileName;
        $this->uploadFile->saveAs($path);
        $this->file = $fileName;
    }

    public function getFileUrl()
    {
        return self::UPLOAD_URL . DIRECTORY_SEPARATOR . $this->file;
    }

    /**
     * Gets query for [[Creator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'creator_id']);
    }

    /**
     * Gets query for [[Executor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::class, ['id' => 'executor_id']);
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }
}
