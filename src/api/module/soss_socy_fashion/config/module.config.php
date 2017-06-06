<?php
return array(
    'router' => array(
        'routes' => array(
            'soss_socy_fashion.rest.themes' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/themes[/:themes_id]',
                    'defaults' => array(
                        'controller' => 'soss_socy_fashion\\V1\\Rest\\Themes\\Controller',
                    ),
                ),
            ),
            'soss_socy_fashion.rest.tags' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/tags[/:tags_id]',
                    'defaults' => array(
                        'controller' => 'soss_socy_fashion\\V1\\Rest\\Tags\\Controller',
                    ),
                ),
            ),
            'soss_socy_fashion.rest.encounters' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/encounters[/:encounters_id]',
                    'defaults' => array(
                        'controller' => 'soss_socy_fashion\\V1\\Rest\\Encounters\\Controller',
                    ),
                ),
            ),
            'soss_socy_fashion.rest.clothing' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/clothing[/:clothing_id]',
                    'defaults' => array(
                        'controller' => 'soss_socy_fashion\\V1\\Rest\\Clothing\\Controller',
                    ),
                ),
            ),
            'soss_socy_fashion.rest.images' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/images[/:images_id]',
                    'defaults' => array(
                        'controller' => 'soss_socy_fashion\\V1\\Rest\\Images\\Controller',
                    ),
                ),
            ),
            'soss_socy_fashion.rest.subjects' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/subjects[/:subjects_id]',
                    'defaults' => array(
                        'controller' => 'soss_socy_fashion\\V1\\Rest\\Subjects\\Controller',
                    ),
                ),
            ),
            'soss_socy_fashion.rest.users' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/users[/:users_id]',
                    'defaults' => array(
                        'controller' => 'soss_socy_fashion\\V1\\Rest\\Users\\Controller',
                    ),
                ),
            ),
            'soss_socy_fashion.rest.me' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/me[/:me_id]',
                    'defaults' => array(
                        'controller' => 'soss_socy_fashion\\V1\\Rest\\Me\\Controller',
                    ),
                ),
            ),
            'soss_socy_fashion.rest.encounter' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/encounter[/:encounter_id]',
                    'defaults' => array(
                        'controller' => 'soss_socy_fashion\\V1\\Rest\\Encounter\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'soss_socy_fashion.rest.themes',
            1 => 'soss_socy_fashion.rest.tags',
            2 => 'soss_socy_fashion.rest.encounters',
            3 => 'soss_socy_fashion.rest.clothing',
            4 => 'soss_socy_fashion.rest.images',
            5 => 'soss_socy_fashion.rest.subjects',
            7 => 'soss_socy_fashion.rest.users',
            8 => 'soss_socy_fashion.rest.me',
            9 => 'soss_socy_fashion.rest.encounter',
        ),
    ),
    'zf-rest' => array(
        'soss_socy_fashion\\V1\\Rest\\Themes\\Controller' => array(
            'listener' => 'soss_socy_fashion\\V1\\Rest\\Themes\\ThemesResource',
            'route_name' => 'soss_socy_fashion.rest.themes',
            'route_identifier_name' => 'themes_id',
            'collection_name' => 'themes',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'soss_socy_fashion\\V1\\Rest\\Themes\\ThemesEntity',
            'collection_class' => 'soss_socy_fashion\\V1\\Rest\\Themes\\ThemesCollection',
            'service_name' => 'themes',
        ),
        'soss_socy_fashion\\V1\\Rest\\Tags\\Controller' => array(
            'listener' => 'soss_socy_fashion\\V1\\Rest\\Tags\\TagsResource',
            'route_name' => 'soss_socy_fashion.rest.tags',
            'route_identifier_name' => 'tags_id',
            'collection_name' => 'tags',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'soss_socy_fashion\\V1\\Rest\\Tags\\TagsEntity',
            'collection_class' => 'soss_socy_fashion\\V1\\Rest\\Tags\\TagsCollection',
            'service_name' => 'tags',
        ),
        'soss_socy_fashion\\V1\\Rest\\Encounters\\Controller' => array(
            'listener' => 'soss_socy_fashion\\V1\\Rest\\Encounters\\EncountersResource',
            'route_name' => 'soss_socy_fashion.rest.encounters',
            'route_identifier_name' => 'encounters_id',
            'collection_name' => 'encounters',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(
                0 => 'theme_id',
            ),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'soss_socy_fashion\\V1\\Rest\\Encounters\\EncountersEntity',
            'collection_class' => 'soss_socy_fashion\\V1\\Rest\\Encounters\\EncountersCollection',
            'service_name' => 'encounters',
        ),
        'soss_socy_fashion\\V1\\Rest\\Clothing\\Controller' => array(
            'listener' => 'soss_socy_fashion\\V1\\Rest\\Clothing\\ClothingResource',
            'route_name' => 'soss_socy_fashion.rest.clothing',
            'route_identifier_name' => 'clothing_id',
            'collection_name' => 'clothing',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'soss_socy_fashion\\V1\\Rest\\Clothing\\ClothingEntity',
            'collection_class' => 'soss_socy_fashion\\V1\\Rest\\Clothing\\ClothingCollection',
            'service_name' => 'clothing',
        ),
        'soss_socy_fashion\\V1\\Rest\\Images\\Controller' => array(
            'listener' => 'soss_socy_fashion\\V1\\Rest\\Images\\ImagesResource',
            'route_name' => 'soss_socy_fashion.rest.images',
            'route_identifier_name' => 'images_id',
            'collection_name' => 'images',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'soss_socy_fashion\\V1\\Rest\\Images\\ImagesEntity',
            'collection_class' => 'soss_socy_fashion\\V1\\Rest\\Images\\ImagesCollection',
            'service_name' => 'images',
        ),
        'soss_socy_fashion\\V1\\Rest\\Subjects\\Controller' => array(
            'listener' => 'soss_socy_fashion\\V1\\Rest\\Subjects\\SubjectsResource',
            'route_name' => 'soss_socy_fashion.rest.subjects',
            'route_identifier_name' => 'subjects_id',
            'collection_name' => 'subjects',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'soss_socy_fashion\\V1\\Rest\\Subjects\\SubjectsEntity',
            'collection_class' => 'soss_socy_fashion\\V1\\Rest\\Subjects\\SubjectsCollection',
            'service_name' => 'subjects',
        ),
        'soss_socy_fashion\\V1\\Rest\\Users\\Controller' => array(
            'listener' => 'soss_socy_fashion\\V1\\Rest\\Users\\UsersResource',
            'route_name' => 'soss_socy_fashion.rest.users',
            'route_identifier_name' => 'users_id',
            'collection_name' => 'users',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'soss_socy_fashion\\V1\\Rest\\Users\\UsersEntity',
            'collection_class' => 'soss_socy_fashion\\V1\\Rest\\Users\\UsersCollection',
            'service_name' => 'users',
        ),
        'soss_socy_fashion\\V1\\Rest\\Me\\Controller' => array(
            'listener' => 'soss_socy_fashion\\V1\\Rest\\Me\\MeResource',
            'route_name' => 'soss_socy_fashion.rest.me',
            'route_identifier_name' => 'me_id',
            'collection_name' => 'me',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'soss_socy_fashion\\V1\\Rest\\Me\\MeEntity',
            'collection_class' => 'soss_socy_fashion\\V1\\Rest\\Me\\MeCollection',
            'service_name' => 'me',
        ),
        'soss_socy_fashion\\V1\\Rest\\Encounter\\Controller' => array(
            'listener' => 'soss_socy_fashion\\V1\\Rest\\Encounter\\EncounterResource',
            'route_name' => 'soss_socy_fashion.rest.encounter',
            'route_identifier_name' => 'encounter_id',
            'collection_name' => 'encounter',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(
                0 => 'filter',
                1 => 'sort',
                2 => 'hasImages',
                3 => 'approved',
                4 => 'notApproved',
                5 => 'owner_id',
                6 => 'theme_id',
            ),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'soss_socy_fashion\\V1\\Rest\\Encounter\\EncounterEntity',
            'collection_class' => 'soss_socy_fashion\\V1\\Rest\\Encounter\\EncounterCollection',
            'service_name' => 'encounter',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'soss_socy_fashion\\V1\\Rest\\Themes\\Controller' => 'HalJson',
            'soss_socy_fashion\\V1\\Rest\\Tags\\Controller' => 'HalJson',
            'soss_socy_fashion\\V1\\Rest\\Encounters\\Controller' => 'HalJson',
            'soss_socy_fashion\\V1\\Rest\\Clothing\\Controller' => 'HalJson',
            'soss_socy_fashion\\V1\\Rest\\Images\\Controller' => 'HalJson',
            'soss_socy_fashion\\V1\\Rest\\Subjects\\Controller' => 'HalJson',
            'soss_socy_fashion\\V1\\Rest\\Users\\Controller' => 'HalJson',
            'soss_socy_fashion\\V1\\Rest\\Me\\Controller' => 'Json',
            'soss_socy_fashion\\V1\\Rest\\Encounter\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'soss_socy_fashion\\V1\\Rest\\Themes\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'soss_socy_fashion\\V1\\Rest\\Tags\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'soss_socy_fashion\\V1\\Rest\\Encounters\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'soss_socy_fashion\\V1\\Rest\\Clothing\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'soss_socy_fashion\\V1\\Rest\\Images\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'soss_socy_fashion\\V1\\Rest\\Subjects\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'soss_socy_fashion\\V1\\Rest\\Users\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'soss_socy_fashion\\V1\\Rest\\Me\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'soss_socy_fashion\\V1\\Rest\\Encounter\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'soss_socy_fashion\\V1\\Rest\\Themes\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/json',
            ),
            'soss_socy_fashion\\V1\\Rest\\Tags\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/json',
            ),
            'soss_socy_fashion\\V1\\Rest\\Encounters\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/json',
            ),
            'soss_socy_fashion\\V1\\Rest\\Clothing\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/json',
            ),
            'soss_socy_fashion\\V1\\Rest\\Images\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/json',
            ),
            'soss_socy_fashion\\V1\\Rest\\Subjects\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/json',
            ),
            'soss_socy_fashion\\V1\\Rest\\Users\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/json',
            ),
            'soss_socy_fashion\\V1\\Rest\\Me\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/json',
            ),
            'soss_socy_fashion\\V1\\Rest\\Encounter\\Controller' => array(
                0 => 'application/vnd.soss_socy_fashion.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'renderer' => array(
            'render_embedded_entities' => true,
            'render_collections' => true,
        ),
        'metadata_map' => array(
            'soss_socy_fashion\\V1\\Rest\\Themes\\ThemesEntity' => array(
                'entity_identifier_name' => 'theme_id',
                'route_name' => 'soss_socy_fashion.rest.themes',
                'route_identifier_name' => 'themes_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'links' => array(
                    'encounters' => array(
                        'rel' => 'encounters',
                        'route' => array(
                            'name' => 'soss_socy_fashion.rest.encounters',
                            'params' => array(
                                'theme_id' => 'theme_id',
                            ),
                            'options' => array(
                                'render_embedded_entities' => true,
                            ),
                        ),
                    ),
                ),
            ),
            'soss_socy_fashion\\V1\\Rest\\Themes\\ThemesCollection' => array(
                'entity_identifier_name' => 'theme_id',
                'route_name' => 'soss_socy_fashion.rest.themes',
                'route_identifier_name' => 'themes_id',
                'is_collection' => true,
                'links' => array(
                    'encounters' => array(
                        'rel' => 'encounters',
                        'route' => array(
                            'name' => 'soss_socy_fashion.rest.encounters',
                            'params' => array(
                                'theme_id' => 'theme_id',
                            ),
                            'options' => array(),
                        ),
                    ),
                ),
            ),
            'soss_socy_fashion\\V1\\Rest\\Tags\\TagsEntity' => array(
                'entity_identifier_name' => 'tag_id',
                'route_name' => 'soss_socy_fashion.rest.tags',
                'route_identifier_name' => 'tags_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'soss_socy_fashion\\V1\\Rest\\Tags\\TagsCollection' => array(
                'entity_identifier_name' => 'tag_id',
                'route_name' => 'soss_socy_fashion.rest.tags',
                'route_identifier_name' => 'tags_id',
                'is_collection' => true,
            ),
            'soss_socy_fashion\\V1\\Rest\\Encounters\\EncountersEntity' => array(
                'entity_identifier_name' => 'encounter_id',
                'route_name' => 'soss_socy_fashion.rest.encounters',
                'route_identifier_name' => 'encounters_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'route_params' => array(
                    0 => 'theme_id',
                ),
            ),
            'soss_socy_fashion\\V1\\Rest\\Encounters\\EncountersCollection' => array(
                'entity_identifier_name' => 'encounter_id',
                'route_name' => 'soss_socy_fashion.rest.encounters',
                'route_identifier_name' => 'encounters_id',
                'is_collection' => true,
                'route_params' => array(
                    0 => 'theme_id',
                ),
            ),
            'soss_socy_fashion\\V1\\Rest\\Clothing\\ClothingEntity' => array(
                'entity_identifier_name' => 'clothing_id',
                'route_name' => 'soss_socy_fashion.rest.clothing',
                'route_identifier_name' => 'clothing_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'soss_socy_fashion\\V1\\Rest\\Clothing\\ClothingCollection' => array(
                'entity_identifier_name' => 'clothing_id',
                'route_name' => 'soss_socy_fashion.rest.clothing',
                'route_identifier_name' => 'clothing_id',
                'is_collection' => true,
            ),
            'soss_socy_fashion\\V1\\Rest\\Images\\ImagesEntity' => array(
                'entity_identifier_name' => 'image_id',
                'route_name' => 'soss_socy_fashion.rest.images',
                'route_identifier_name' => 'images_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'soss_socy_fashion\\V1\\Rest\\Images\\ImagesCollection' => array(
                'entity_identifier_name' => 'image_id',
                'route_name' => 'soss_socy_fashion.rest.images',
                'route_identifier_name' => 'images_id',
                'is_collection' => true,
            ),
            'soss_socy_fashion\\V1\\Rest\\Subjects\\SubjectsEntity' => array(
                'entity_identifier_name' => 'subject_id',
                'route_name' => 'soss_socy_fashion.rest.subjects',
                'route_identifier_name' => 'subjects_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'soss_socy_fashion\\V1\\Rest\\Subjects\\SubjectsCollection' => array(
                'entity_identifier_name' => 'subject_id',
                'route_name' => 'soss_socy_fashion.rest.subjects',
                'route_identifier_name' => 'subjects_id',
                'is_collection' => true,
            ),
            'soss_socy_fashion\\V1\\Rest\\Users\\UsersEntity' => array(
                'entity_identifier_name' => 'user_id',
                'route_name' => 'soss_socy_fashion.rest.users',
                'route_identifier_name' => 'users_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'soss_socy_fashion\\V1\\Rest\\Users\\UsersCollection' => array(
                'entity_identifier_name' => 'user_id',
                'route_name' => 'soss_socy_fashion.rest.users',
                'route_identifier_name' => 'users_id',
                'is_collection' => true,
            ),
            'soss_socy_fashion\\V1\\Rest\\Me\\MeEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'soss_socy_fashion.rest.me',
                'route_identifier_name' => 'me_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'soss_socy_fashion\\V1\\Rest\\Me\\MeCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'soss_socy_fashion.rest.me',
                'route_identifier_name' => 'me_id',
                'is_collection' => true,
            ),
            'soss_socy_fashion\\V1\\Rest\\Encounter\\EncounterEntity' => array(
                'entity_identifier_name' => 'encounter_id',
                'route_name' => 'soss_socy_fashion.rest.encounter',
                'route_identifier_name' => 'encounter_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ObjectProperty',
            ),
            'soss_socy_fashion\\V1\\Rest\\Encounter\\EncounterCollection' => array(
                'entity_identifier_name' => 'encounter_id',
                'route_name' => 'soss_socy_fashion.rest.encounter',
                'route_identifier_name' => 'encounter_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-apigility' => array(
        'db-connected' => array(
            'soss_socy_fashion\\V1\\Rest\\Themes\\ThemesResource' => array(
                'adapter_name' => 'uom_soss_socy_fashion',
                'table_name' => 'themes',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'soss_socy_fashion\\V1\\Rest\\Themes\\Controller',
                'entity_identifier_name' => 'theme_id',
                'table_service' => 'soss_socy_fashion\\V1\\Rest\\Themes\\ThemesResource\\Table',
            ),
            'soss_socy_fashion\\V1\\Rest\\Tags\\TagsResource' => array(
                'adapter_name' => 'uom_soss_socy_fashion',
                'table_name' => 'tags',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'soss_socy_fashion\\V1\\Rest\\Tags\\Controller',
                'entity_identifier_name' => 'tag_id',
                'table_service' => 'soss_socy_fashion\\V1\\Rest\\Tags\\TagsResource\\Table',
            ),
            'soss_socy_fashion\\V1\\Rest\\Encounters\\EncountersResource' => array(
                'adapter_name' => 'uom_soss_socy_fashion',
                'table_name' => 'encounters',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'soss_socy_fashion\\V1\\Rest\\Encounters\\Controller',
                'entity_identifier_name' => 'encounter_id',
                'table_service' => 'soss_socy_fashion\\V1\\Rest\\Encounters\\EncountersResource\\Table',
            ),
            'soss_socy_fashion\\V1\\Rest\\Clothing\\ClothingResource' => array(
                'adapter_name' => 'uom_soss_socy_fashion',
                'table_name' => 'clothing',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'soss_socy_fashion\\V1\\Rest\\Clothing\\Controller',
                'entity_identifier_name' => 'clothing_id',
                'table_service' => 'soss_socy_fashion\\V1\\Rest\\Clothing\\ClothingResource\\Table',
            ),
            'soss_socy_fashion\\V1\\Rest\\Images\\ImagesResource' => array(
                'adapter_name' => 'uom_soss_socy_fashion',
                'table_name' => 'images',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'soss_socy_fashion\\V1\\Rest\\Images\\Controller',
                'entity_identifier_name' => 'image_id',
                'table_service' => 'soss_socy_fashion\\V1\\Rest\\Images\\ImagesResource\\Table',
            ),
            'soss_socy_fashion\\V1\\Rest\\Subjects\\SubjectsResource' => array(
                'adapter_name' => 'uom_soss_socy_fashion',
                'table_name' => 'subjects',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'soss_socy_fashion\\V1\\Rest\\Subjects\\Controller',
                'entity_identifier_name' => 'subject_id',
                'table_service' => 'soss_socy_fashion\\V1\\Rest\\Subjects\\SubjectsResource\\Table',
            ),
            'soss_socy_fashion\\V1\\Rest\\Users\\UsersResource' => array(
                'adapter_name' => 'uom_soss_socy_fashion',
                'table_name' => 'users',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'soss_socy_fashion\\V1\\Rest\\Users\\Controller',
                'entity_identifier_name' => 'user_id',
                'table_service' => 'soss_socy_fashion\\V1\\Rest\\Users\\UsersResource\\Table',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'soss_socy_fashion\\V1\\Rest\\Me\\MeResource' => 'soss_socy_fashion\\V1\\Rest\\Me\\MeResourceFactory',
            'soss_socy_fashion\\V1\\Rest\\Encounter\\EncounterResource' => 'soss_socy_fashion\\V1\\Rest\\Encounter\\EncounterResourceFactory',
        ),
    ),
    'zf-content-validation' => array(
        'soss_socy_fashion\\V1\\Rest\\Encounter\\Controller' => array(
            'input_filter' => 'soss_socy_fashion\\V1\\Rest\\Encounter\\Validator',
        ),
        'soss_socy_fashion\\V1\\Rest\\Encounters\\Controller' => array(
            'input_filter' => 'soss_socy_fashion\\V1\\Rest\\Encounters\\Validator',
        ),
        'soss_socy_fashion\\V1\\Rest\\Themes\\Controller' => array(
            'input_filter' => 'soss_socy_fashion\\V1\\Rest\\Themes\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'soss_socy_fashion\\V1\\Rest\\Encounter\\Validator' => array(
            0 => array(
                'name' => 'title',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Title of the service',
            ),
            1 => array(
                'name' => 'look',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
                'description' => 'Look of the encounter',
            ),
            2 => array(
                'name' => 'encounter_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
        'soss_socy_fashion\\V1\\Rest\\Encounters\\Validator' => array(
            0 => array(
                'name' => 'encounter_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            1 => array(
                'name' => 'theme_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
        'soss_socy_fashion\\V1\\Rest\\Themes\\Validator' => array(
            0 => array(
                'name' => 'theme_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'theme_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
        ),
    ),
);
