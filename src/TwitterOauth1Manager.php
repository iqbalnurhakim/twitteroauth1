<?php namespace IqbalHakim\TwitterOauth1;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;
use IqbalHakim\TwitterOauth1\TwitterOauth1Factory;

class TwitterOauth1Manager extends AbstractManager {

  /**
   * @var InstagramFactory
   */
  private $factory;

  /**
   * @param Repository $config
   * @param InstagramFactory $factory
   */
  function __construct(Repository $config, TwitterOauth1Factory $factory)
  {
    // var_dump($config);
    parent::__construct($config);

    $this->factory = $factory;

  }

  /**
   * Create the connection instance.
   *
   * @param array $config
   *
   * @return mixed
   */
  protected function createConnection(array $config)
  {
    // var_dump($config);
    return $this->factory->make($config);
  }

  /**
   * Get the configuration name.
   *
   * @return string
   */
  protected function getConfigName()
  {
    return 'twitter';
  }

  /**
   * Get the factory instance.
   *
   * @return InstagramFactory
   */
  public function getFactory()
  {
    return $this->factory;
  }

}
