Symfony Doc Synchronizer
========================

Aims to ease translation process of Symfony documentation.

Generate cache
--------------

This project needs to warm cache, to have metadatas of documentation.

Run it:

.. code-block:: bash

    php app/console symfony:build-documentation

Backlog
-------

* Serialize to short processing time
* Generate diff of 2 ASTs
* Web UI
* Persist the AST with Doctrine
* Detect and integrate Sphinx errors in AST - http://symfony.com/doc/build_errors
* Split code blocks and Sphinx directives
