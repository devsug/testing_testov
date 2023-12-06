<?php

namespace DataBases;

/**
 * Интерфейс для стандартных интерфейсов для БД
 *
 * @author Valery Shibaev
 * @version 1.0, 05.11.2023
 */
interface DataBaseDefault extends DatabaseFetches, DatabaseConnection, DatabaseChanges {}