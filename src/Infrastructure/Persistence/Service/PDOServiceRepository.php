<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Service;

use App\Domain\Service\Service;
use App\Domain\Service\ServiceNotFoundException;
use App\Domain\Service\ServiceRepository;
use PDO;
use PDOException;
use Psr\Log\LoggerInterface;

class PDOServiceRepository implements ServiceRepository {
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * PDOServiceRepository constructor.
     *
     * @param PDO $pdo Database interface
     * @param LoggerInterface $logger Logger interface
     */
    public function __construct(PDO $pdo, LoggerInterface $logger) {
        $this->pdo = $pdo;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function find(?int $max=10, ?int $offset=0): array {
        try {
            // TODO: Починить загрузку контента "по частям"
            $stmt = $this->pdo->prepare('SELECT * FROM `services`'/*' LIMIT :offset, :max'*/);
            if($stmt->execute()) {
                $output = [];
                while ($row = $stmt->fetch()) {
                    $output[] = new Service(intval($row['id']), $row['title'], $row['text'], $row['image']);
                }
                return $output;
            } else {
                return [];
            }
        } catch (PDOException $e) {
            $this->logger->error($e->getMessage() . " on " . __FILE__);
            return [];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function findServiceOfId(int $id): Service {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM `services` WHERE `id` = :id');
            $stmt->bindParam('id', $id, PDO::PARAM_INT);
            if($stmt->execute() && $row = $stmt->fetch()) {
                return new Service(intval($row['id']), $row['title'], $row['text'], $row['image']);;
            } else {
                throw new ServiceNotFoundException();
            }
        } catch (PDOException $e) {
            $this->logger->error($e->getMessage() . " on " . __FILE__);
            throw new ServiceNotFoundException();
        }
    }
}
