# Job-Hub

## Objective

Job-Hub is a dynamic job listing filtering system that allows users to apply complex filters efficiently. The system supports filtering by direct fields, related entities, and entity-attribute-value (EAV) models, ensuring a flexible and scalable approach to job searching.

## Technologies

| Type    | Name / Version |
| ------- | -------------- |
| PHP     | 8.4.3          |
| Laravel | 12             |
| Docker  | Custom Docker  |
| DB      | MySQL/8.0      |

## Prerequisites

- Install [Docker](https://docs.docker.com/engine/install/)
- Start Docker

## Setup

### Local Installation

1. Clone the repository:

    ```shell
    git clone https://github.com/AbdelrhamanAmin/job-hub.git
    ```

2. Navigate to the project directory:

    ```shell
    cd order-payment
    ```

3. Duplicate `.env.example` to `.env`:

    ```shell
    cp .env.example .env
    ```

4. Start the development environment:

    ```shell
    make up
    ```

5. Setup the database and seed data:

    ```shell
    make local-setup
    ```

## Technical Details

### Filtering System

The system supports three types of filters:

1. **Basic Filters:** Direct filters on database columns.
2. **Relation Filters:** Filters applied to related entities.
3. **EAV Filters:** Filters for dynamic attributes stored in a separate entity-attribute-value (EAV) table, allowing flexibility for job attributes.

### Performance Enhancements

- **Avoids N+1 Queries:** Queries are optimized using eager loading.
- **Indexing & Pagination:** Database indexing and pagination are implemented to ensure optimal performance.
- **Optimized Query Structure:** The filtering system dynamically applies conditions to the query builder, reducing redundant queries.

## Usage

### Available Commands

| Command              | Description                                  |
| -------------------- | -------------------------------------------- |
| `make help`         | List all available make commands            |
| `make up`          | Build and start Docker containers           |
| `make rebuild`     | Rebuild Docker images                       |
| `make down`        | Stop Docker containers and remove images    |
| `make migrate`     | Run migrations and seeders                  |
| `make clean`       | Clear application cache                     |

## Filtering System

### Filter Structure

Filters can be applied using query parameters with the following structure:

```plaintext
filter[target_column][operator]=value
```

For **EAV filtering**, use:

```plaintext
filter[attribute:attribute_name][operator]=value
```

### Supported Operators

| Operator  | Meaning                 | Example |
|-----------|-------------------------|---------|
| `=`       | Equal to                 | `filter[job_type][=]=full-time` |
| `!=`      | Not equal to             | `filter[status][!=]=closed` |
| `>`       | Greater than             | `filter[salary_min][>]=5000` |
| `<`       | Less than                | `filter[salary_max][<]=10000` |
| `>=`      | Greater than or equal to | `filter[salary_min][>=]=3000` |
| `<=`      | Less than or equal to    | `filter[salary_max][<=]=8000` |
| `like`    | Partial match            | `filter[company_name][LIKE]=Tech%` |
| `in`      | Multiple values          | `filter[job_type][IN]=full-time,part-time` |

### Relation Filtering

To filter based on relations:

```plaintext
filter[relation][operator]=value
```

Examples:

```plaintext
filter[languages][=]=PHP
filter[locations][LIKE]=London
```

### EAV Filtering

For dynamic attributes stored in the EAV model:

```plaintext
filter[attribute:experience_level][=]=junior
filter[attribute:skills][IN]=PHP,Laravel
```

## API Endpoint

### Filter Jobs

**Endpoint:**

```plaintext
GET /api/jobs
```

**Query Parameters:**

```plaintext
filter[job_type][=]=full-time
filter[salary_min][>=]=5000
filter[locations][=]=London
filter[attribute:experience_level][=]=junior
```

**Example Request:**

```shell
curl -X GET "http://localhost/api/jobs?filter[job_type][=]=full-time&filter[salary_min][>=]=5000"
```

### Postman Collection

You can find the Postman collection [postman_collection.json] file  in project dir.

## Code Quality

I have applied clean code principles and used design patterns where applicable to keep the code maintainable and scalable.

## Future Enhancements

- Implement a **response handler** for consistent API responses.
- Add **response resources** for structured endpoint outputs.
- Implement **unit tests** to ensure reliability.

---