# Hierarchical Config
======================

Documentation on its way. This is a tool to assist in creating hierarchical configurations, where layers of configuration data are merged, with higher layers overwriting lower layers.

# How To Use
============

First, you must add this library to your project. If you are using composer, try this:
    > composer require bshirey/hierarchical-config:1.*

This library does not do much on its own, but requires some setup in your project.
At a minimum, you must implement your own ConfigBuilder with a custom implementation of the build() function.
    The ConfigBuilder is responsible to instantiating ConfigInterface objects.
    The ConfigBuilder is responsible for stacking ConfigInterface objects hierarchically.

For example:

```sh
    public class MyApplicationConfigBuilder implements ConfigBuilder
    {
        public function build($options = array())
        {
            $config = new GenericConfig($options);
            $config
                ->push(new FileConfig($options))
                ->push(new GlobalsConfig($options))
                ->push(new EnvConfig($options));

            return $config;
        }
        ...
```

Then your application needs to setup the ConfigFactory singleton, similar to the following:

```sh
    ConfigFactory::getInstance()
                ->setOptions($options)
                ->setBuilder(new MyApplicationConfigBuilder());
```

Finally, you must make your configurable classes / objects use the HierarchicalConfig\Configurable trait:

```sh
    use HierarchicalConfig\Configurable;

    public class MyApplicationClass
    {
       use Configurable;
       ...

```
