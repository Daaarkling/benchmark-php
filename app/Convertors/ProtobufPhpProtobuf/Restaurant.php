<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : restaurants.proto
 */


namespace Benchmark\Converters\ProtobufPhpProtobuf;

/**
 * Protobuf message : protobufPhpProtobuf.Restaurant
 */
class Restaurant extends \Protobuf\AbstractMessage
{

    /**
     * @var \Protobuf\UnknownFieldSet
     */
    protected $unknownFieldSet = null;

    /**
     * @var \Protobuf\Extension\ExtensionFieldMap
     */
    protected $extensions = null;

    /**
     * id required int32 = 1
     *
     * @var int
     */
    protected $id = null;

    /**
     * name required string = 2
     *
     * @var string
     */
    protected $name = null;

    /**
     * description optional string = 3
     *
     * @var string
     */
    protected $description = null;

    /**
     * menuLink optional string = 4
     *
     * @var string
     */
    protected $menuLink = null;

    /**
     * imageLink optional string = 5
     *
     * @var string
     */
    protected $imageLink = null;

    /**
     * contact required message = 6
     *
     * @var \Benchmark\Converters\ProtobufPhpProtobuf\Contact
     */
    protected $contact = null;

    /**
     * address required message = 7
     *
     * @var \Benchmark\Converters\ProtobufPhpProtobuf\Address
     */
    protected $address = null;

    /**
     * openingTime repeated message = 8
     *
     * @var \Protobuf\Collection<\Benchmark\Converters\ProtobufPhpProtobuf\OpeningTime>
     */
    protected $openingTime = null;

    /**
     * Check if 'id' has a value
     *
     * @return bool
     */
    public function hasId()
    {
        return $this->id !== null;
    }

    /**
     * Get 'id' value
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set 'id' value
     *
     * @param int $value
     */
    public function setId($value)
    {
        $this->id = $value;
    }

    /**
     * Check if 'name' has a value
     *
     * @return bool
     */
    public function hasName()
    {
        return $this->name !== null;
    }

    /**
     * Get 'name' value
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set 'name' value
     *
     * @param string $value
     */
    public function setName($value)
    {
        $this->name = $value;
    }

    /**
     * Check if 'description' has a value
     *
     * @return bool
     */
    public function hasDescription()
    {
        return $this->description !== null;
    }

    /**
     * Get 'description' value
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set 'description' value
     *
     * @param string $value
     */
    public function setDescription($value = null)
    {
        $this->description = $value;
    }

    /**
     * Check if 'menuLink' has a value
     *
     * @return bool
     */
    public function hasMenuLink()
    {
        return $this->menuLink !== null;
    }

    /**
     * Get 'menuLink' value
     *
     * @return string
     */
    public function getMenuLink()
    {
        return $this->menuLink;
    }

    /**
     * Set 'menuLink' value
     *
     * @param string $value
     */
    public function setMenuLink($value = null)
    {
        $this->menuLink = $value;
    }

    /**
     * Check if 'imageLink' has a value
     *
     * @return bool
     */
    public function hasImageLink()
    {
        return $this->imageLink !== null;
    }

    /**
     * Get 'imageLink' value
     *
     * @return string
     */
    public function getImageLink()
    {
        return $this->imageLink;
    }

    /**
     * Set 'imageLink' value
     *
     * @param string $value
     */
    public function setImageLink($value = null)
    {
        $this->imageLink = $value;
    }

    /**
     * Check if 'contact' has a value
     *
     * @return bool
     */
    public function hasContact()
    {
        return $this->contact !== null;
    }

    /**
     * Get 'contact' value
     *
     * @return \Benchmark\Converters\ProtobufPhpProtobuf\Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set 'contact' value
     *
     * @param \Benchmark\Converters\ProtobufPhpProtobuf\Contact $value
     */
    public function setContact(\Benchmark\Converters\ProtobufPhpProtobuf\Contact $value)
    {
        $this->contact = $value;
    }

    /**
     * Check if 'address' has a value
     *
     * @return bool
     */
    public function hasAddress()
    {
        return $this->address !== null;
    }

    /**
     * Get 'address' value
     *
     * @return \Benchmark\Converters\ProtobufPhpProtobuf\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set 'address' value
     *
     * @param \Benchmark\Converters\ProtobufPhpProtobuf\Address $value
     */
    public function setAddress(\Benchmark\Converters\ProtobufPhpProtobuf\Address $value)
    {
        $this->address = $value;
    }

    /**
     * Check if 'openingTime' has a value
     *
     * @return bool
     */
    public function hasOpeningTimeList()
    {
        return $this->openingTime !== null;
    }

    /**
     * Get 'openingTime' value
     *
     * @return \Protobuf\Collection<\Benchmark\Converters\ProtobufPhpProtobuf\OpeningTime>
     */
    public function getOpeningTimeList()
    {
        return $this->openingTime;
    }

    /**
     * Set 'openingTime' value
     *
     * @param \Protobuf\Collection<\Benchmark\Converters\ProtobufPhpProtobuf\OpeningTime> $value
     */
    public function setOpeningTimeList(\Protobuf\Collection $value = null)
    {
        $this->openingTime = $value;
    }

    /**
     * Add a new element to 'openingTime'
     *
     * @param \Benchmark\Converters\ProtobufPhpProtobuf\OpeningTime $value
     */
    public function addOpeningTime(\Benchmark\Converters\ProtobufPhpProtobuf\OpeningTime $value)
    {
        if ($this->openingTime === null) {
            $this->openingTime = new \Protobuf\MessageCollection();
        }

        $this->openingTime->add($value);
    }

    /**
     * {@inheritdoc}
     */
    public function extensions()
    {
        if ( $this->extensions !== null) {
            return $this->extensions;
        }

        return $this->extensions = new \Protobuf\Extension\ExtensionFieldMap(__CLASS__);
    }

    /**
     * {@inheritdoc}
     */
    public function unknownFieldSet()
    {
        return $this->unknownFieldSet;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromStream($stream, \Protobuf\Configuration $configuration = null)
    {
        return new self($stream, $configuration);
    }

    /**
     * {@inheritdoc}
     */
    public static function fromArray(array $values)
    {
        if ( ! isset($values['id'])) {
            throw new \InvalidArgumentException('Field "id" (tag 1) is required but has no value.');
        }

        if ( ! isset($values['name'])) {
            throw new \InvalidArgumentException('Field "name" (tag 2) is required but has no value.');
        }

        if ( ! isset($values['contact'])) {
            throw new \InvalidArgumentException('Field "contact" (tag 6) is required but has no value.');
        }

        if ( ! isset($values['address'])) {
            throw new \InvalidArgumentException('Field "address" (tag 7) is required but has no value.');
        }

        $message = new self();
        $values  = array_merge([
            'description' => null,
            'menuLink' => null,
            'imageLink' => null,
            'openingTime' => []
        ], $values);

        $message->setId($values['id']);
        $message->setName($values['name']);
        $message->setDescription($values['description']);
        $message->setMenuLink($values['menuLink']);
        $message->setImageLink($values['imageLink']);
        $message->setContact($values['contact']);
        $message->setAddress($values['address']);

        foreach ($values['openingTime'] as $item) {
            $message->addOpeningTime($item);
        }

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public static function descriptor()
    {
        return \google\protobuf\DescriptorProto::fromArray([
            'name'      => 'Restaurant',
            'field'     => [
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 1,
                    'name' => 'id',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_INT32(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REQUIRED()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 2,
                    'name' => 'name',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_STRING(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REQUIRED()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 3,
                    'name' => 'description',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_STRING(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 4,
                    'name' => 'menuLink',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_STRING(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 5,
                    'name' => 'imageLink',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_STRING(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 6,
                    'name' => 'contact',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REQUIRED(),
                    'type_name' => '.protobufPhpProtobuf.Contact'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 7,
                    'name' => 'address',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REQUIRED(),
                    'type_name' => '.protobufPhpProtobuf.Address'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 8,
                    'name' => 'openingTime',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REPEATED(),
                    'type_name' => '.protobufPhpProtobuf.OpeningTime'
                ]),
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function toStream(\Protobuf\Configuration $configuration = null)
    {
        $config  = $configuration ?: \Protobuf\Configuration::getInstance();
        $context = $config->createWriteContext();
        $stream  = $context->getStream();

        $this->writeTo($context);
        $stream->seek(0);

        return $stream;
    }

    /**
     * {@inheritdoc}
     */
    public function writeTo(\Protobuf\WriteContext $context)
    {
        $stream      = $context->getStream();
        $writer      = $context->getWriter();
        $sizeContext = $context->getComputeSizeContext();

        if ($this->id === null) {
            throw new \UnexpectedValueException('Field "\\Benchmark\\Converters\\ProtobufPhpProtobuf\\Restaurant#id" (tag 1) is required but has no value.');
        }

        if ($this->name === null) {
            throw new \UnexpectedValueException('Field "\\Benchmark\\Converters\\ProtobufPhpProtobuf\\Restaurant#name" (tag 2) is required but has no value.');
        }

        if ($this->contact === null) {
            throw new \UnexpectedValueException('Field "\\Benchmark\\Converters\\ProtobufPhpProtobuf\\Restaurant#contact" (tag 6) is required but has no value.');
        }

        if ($this->address === null) {
            throw new \UnexpectedValueException('Field "\\Benchmark\\Converters\\ProtobufPhpProtobuf\\Restaurant#address" (tag 7) is required but has no value.');
        }

        if ($this->id !== null) {
            $writer->writeVarint($stream, 8);
            $writer->writeVarint($stream, $this->id);
        }

        if ($this->name !== null) {
            $writer->writeVarint($stream, 18);
            $writer->writeString($stream, $this->name);
        }

        if ($this->description !== null) {
            $writer->writeVarint($stream, 26);
            $writer->writeString($stream, $this->description);
        }

        if ($this->menuLink !== null) {
            $writer->writeVarint($stream, 34);
            $writer->writeString($stream, $this->menuLink);
        }

        if ($this->imageLink !== null) {
            $writer->writeVarint($stream, 42);
            $writer->writeString($stream, $this->imageLink);
        }

        if ($this->contact !== null) {
            $writer->writeVarint($stream, 50);
            $writer->writeVarint($stream, $this->contact->serializedSize($sizeContext));
            $this->contact->writeTo($context);
        }

        if ($this->address !== null) {
            $writer->writeVarint($stream, 58);
            $writer->writeVarint($stream, $this->address->serializedSize($sizeContext));
            $this->address->writeTo($context);
        }

        if ($this->openingTime !== null) {
            foreach ($this->openingTime as $val) {
                $writer->writeVarint($stream, 66);
                $writer->writeVarint($stream, $val->serializedSize($sizeContext));
                $val->writeTo($context);
            }
        }

        if ($this->extensions !== null) {
            $this->extensions->writeTo($context);
        }

        return $stream;
    }

    /**
     * {@inheritdoc}
     */
    public function readFrom(\Protobuf\ReadContext $context)
    {
        $reader = $context->getReader();
        $length = $context->getLength();
        $stream = $context->getStream();

        $limit = ($length !== null)
            ? ($stream->tell() + $length)
            : null;

        while ($limit === null || $stream->tell() < $limit) {

            if ($stream->eof()) {
                break;
            }

            $key  = $reader->readVarint($stream);
            $wire = \Protobuf\WireFormat::getTagWireType($key);
            $tag  = \Protobuf\WireFormat::getTagFieldNumber($key);

            if ($stream->eof()) {
                break;
            }

            if ($tag === 1) {
                \Protobuf\WireFormat::assertWireType($wire, 5);

                $this->id = $reader->readVarint($stream);

                continue;
            }

            if ($tag === 2) {
                \Protobuf\WireFormat::assertWireType($wire, 9);

                $this->name = $reader->readString($stream);

                continue;
            }

            if ($tag === 3) {
                \Protobuf\WireFormat::assertWireType($wire, 9);

                $this->description = $reader->readString($stream);

                continue;
            }

            if ($tag === 4) {
                \Protobuf\WireFormat::assertWireType($wire, 9);

                $this->menuLink = $reader->readString($stream);

                continue;
            }

            if ($tag === 5) {
                \Protobuf\WireFormat::assertWireType($wire, 9);

                $this->imageLink = $reader->readString($stream);

                continue;
            }

            if ($tag === 6) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \Benchmark\Converters\ProtobufPhpProtobuf\Contact();

                $this->contact = $innerMessage;

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

                continue;
            }

            if ($tag === 7) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \Benchmark\Converters\ProtobufPhpProtobuf\Address();

                $this->address = $innerMessage;

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

                continue;
            }

            if ($tag === 8) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \Benchmark\Converters\ProtobufPhpProtobuf\OpeningTime();

                if ($this->openingTime === null) {
                    $this->openingTime = new \Protobuf\MessageCollection();
                }

                $this->openingTime->add($innerMessage);

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

                continue;
            }

            $extensions = $context->getExtensionRegistry();
            $extension  = $extensions ? $extensions->findByNumber(__CLASS__, $tag) : null;

            if ($extension !== null) {
                $this->extensions()->add($extension, $extension->readFrom($context, $wire));

                continue;
            }

            if ($this->unknownFieldSet === null) {
                $this->unknownFieldSet = new \Protobuf\UnknownFieldSet();
            }

            $data    = $reader->readUnknown($stream, $wire);
            $unknown = new \Protobuf\Unknown($tag, $wire, $data);

            $this->unknownFieldSet->add($unknown);

        }
    }

    /**
     * {@inheritdoc}
     */
    public function serializedSize(\Protobuf\ComputeSizeContext $context)
    {
        $calculator = $context->getSizeCalculator();
        $size       = 0;

        if ($this->id !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->id);
        }

        if ($this->name !== null) {
            $size += 1;
            $size += $calculator->computeStringSize($this->name);
        }

        if ($this->description !== null) {
            $size += 1;
            $size += $calculator->computeStringSize($this->description);
        }

        if ($this->menuLink !== null) {
            $size += 1;
            $size += $calculator->computeStringSize($this->menuLink);
        }

        if ($this->imageLink !== null) {
            $size += 1;
            $size += $calculator->computeStringSize($this->imageLink);
        }

        if ($this->contact !== null) {
            $innerSize = $this->contact->serializedSize($context);

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->address !== null) {
            $innerSize = $this->address->serializedSize($context);

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->openingTime !== null) {
            foreach ($this->openingTime as $val) {
                $innerSize = $val->serializedSize($context);

                $size += 1;
                $size += $innerSize;
                $size += $calculator->computeVarintSize($innerSize);
            }
        }

        if ($this->extensions !== null) {
            $size += $this->extensions->serializedSize($context);
        }

        return $size;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->description = null;
        $this->menuLink = null;
        $this->imageLink = null;
        $this->contact = null;
        $this->address = null;
        $this->openingTime = null;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(\Protobuf\Message $message)
    {
        if ( ! $message instanceof \Benchmark\Converters\ProtobufPhpProtobuf\Restaurant) {
            throw new \InvalidArgumentException(sprintf('Argument 1 passed to %s must be a %s, %s given', __METHOD__, __CLASS__, get_class($message)));
        }

        $this->id = ($message->id !== null) ? $message->id : $this->id;
        $this->name = ($message->name !== null) ? $message->name : $this->name;
        $this->description = ($message->description !== null) ? $message->description : $this->description;
        $this->menuLink = ($message->menuLink !== null) ? $message->menuLink : $this->menuLink;
        $this->imageLink = ($message->imageLink !== null) ? $message->imageLink : $this->imageLink;
        $this->contact = ($message->contact !== null) ? $message->contact : $this->contact;
        $this->address = ($message->address !== null) ? $message->address : $this->address;
        $this->openingTime = ($message->openingTime !== null) ? $message->openingTime : $this->openingTime;
    }


}

