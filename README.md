# Survos Admin Bundle

`survos/admin-bundle` is the registry-driven admin/workbench shell for Survos applications.

It is intentionally not a CRUD generator and does not depend on EasyAdmin. It provides an explicit admin context, Tabler-based layout, and contribution contracts that Survos ecosystem bundles can use to expose their registries and tools in one consistent UI.

## Goals

- Provide a dedicated admin UI separate from the public application UI.
- Use Tabler for layout and navigation.
- Let Survos bundles contribute admin sections from compiler-pass registries.
- Keep bundle routes normal Symfony routes with stable names and no EasyAdmin route prefixing.
- Prefer read-only registry/workbench pages by default; opt into mutation explicitly.

## Core Concepts

Bundles contribute admin UI through `AdminContributorInterface` services. A contributor returns one or more `AdminSection` objects. Sections can expose links, cards, counts, descriptions, and grouping metadata.

Initial section groups are intentionally broad:

- Entities
- Search
- Workflows
- AI
- Data
- System

## Installation

```bash
composer require survos/admin-bundle
```

Enable the bundle if Flex does not do it automatically:

```php
Survos\AdminBundle\SurvosAdminBundle::class => ['all' => true],
```

The default dashboard route is `/admin`.

## Status

This package is the replacement direction for Survos ecosystem admin pages that previously used EasyAdmin for navigation and shell behavior.
