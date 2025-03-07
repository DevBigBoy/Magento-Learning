<?php

// Import the ComponentRegistrar class from the Magento framework.
// This class is responsible for registering components like modules, themes, and language packs.
use Magento\Framework\Component\ComponentRegistrar;

// Register the module with Magento.
// The register method takes three arguments: type of component, module name, and module directory.
ComponentRegistrar::register(
    ComponentRegistrar::MODULE, // Specify that this is a module registration.
    'Learning_JobManager',     // Name of the module (in Vendor_Module format).
    __DIR__                    // Directory of the current file (points to the module's location).
);
