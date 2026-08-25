# Comprehensive Interview Preparation Guide (40+ Questions for 2.5 YoE)

This document contains **41 detailed interview questions** specifically tailored for a developer with 2.5 years of experience. It covers complete OOP, exhaustive core PHP functions, Algorithms, Security, and dedicated sections for ORM concepts and Laravel Architecture.

---

## 1. Object-Oriented Programming (OOP) in PHP

**Q1: Explain the four pillars of OOP with PHP examples.**
* **Hint:**
    1. **Encapsulation:** Hiding internal state using `public`, `private`, `protected`.
    2. **Inheritance:** Deriving properties/methods from a parent using `extends`.
    3. **Polymorphism:** Method Overriding (children classes implementing the same method differently).
    4. **Abstraction:** Hiding complex implementation using `abstract` classes or `interfaces`.

**Q2: What is the exact difference between an Abstract Class and an Interface?**
* **Hint:** 
    * **Interface:** Only method signatures (no implementation). A class can implement *multiple* interfaces. All methods must be public.
    * **Abstract Class:** Can have both implemented and abstract methods. A class can inherit from *only one* abstract class. Can have protected/private properties.

**Q3: What are Traits in PHP and why do we use them?**
* **Hint:** PHP only supports single inheritance. Traits allow you to reuse methods freely in multiple independent classes. Used via the `use` keyword inside a class.

**Q4: Explain Late Static Binding (`self::` vs `static::`).**
* **Hint:** `self::` refers to the class where the method is *written*. `static::` refers to the class that was *instantiated* at runtime. If a child class overrides a static property, using `static::` in the parent method correctly references the child's property.

**Q5: Name 5 Magic Methods in PHP and what they do.**
* **Hint:** 
    1. `__construct()`: Called on object creation.
    2. `__destruct()`: Called on object destruction.
    3. `__get($name)`: Accessing inaccessible/private properties.
    4. `__set($name, $value)`: Updating inaccessible properties.
    5. `__call($name, $args)`: Invoking inaccessible methods.

**Q6: What is Dependency Injection (DI)?**
* **Hint:** Instead of a class creating its dependencies inside itself (e.g., `$db = new Database()`), the dependencies are passed (injected) into the class via the constructor. This makes testing much easier and reduces tight coupling.

**Q7: Explain Method Overriding vs Method Overloading in PHP.**
* **Hint:** 
    * **Overriding:** Redefining a parent class's method in a child class.
    * **Overloading:** Creating multiple methods with the same name but different parameters. *Note: PHP does not natively support traditional method overloading.* It uses magic methods (`__call`) to simulate it.

---

## 2. Core PHP & Version Differences

**Q8: What are the major differences introduced in PHP 7 vs PHP 8?**
* **Hint:**
    * **PHP 7:** Scalar Type Declarations (`int`, `string`), Return Types, Null Coalescing (`??`), Spaceship Operator (`<=>`).
    * **PHP 8:** Named Arguments, Constructor Property Promotion, Attributes, Match Expressions (better `switch`), Nullsafe Operator (`?->`), Union Types (`int|string`), JIT compiler.

**Q9: Explain the difference between `isset()`, `empty()`, and `is_null()`.**
* **Hint:**
    * `isset()`: True if declared and *not* `null`.
    * `empty()`: True if empty string, `0`, `null`, `false`, or empty array.
    * `is_null()`: True *only* if strictly `null`.

**Q10: Difference between `require`, `require_once`, `include`, and `include_once`?**
* **Hint:** `require` throws a Fatal Error and stops the script if the file is missing. `include` throws a Warning and continues. The `_once` suffix ensures the file is only included a single time to prevent function re-declaration errors.

**Q11: What is the difference between `==` and `===`?**
* **Hint:** `==` checks for value equality after type juggling (e.g., `"1" == 1` is true). `===` checks for strict equality (both value AND type must match, so `"1" === 1` is false).

**Q12: Sessions vs Cookies?**
* **Hint:** Sessions store data on the server and are more secure (only a session ID is stored on the client). Cookies store data directly on the user's browser, which can be tampered with.

---

## 3. PHP Array Functions

**Q13: Explain `array_map`, `array_filter`, and `array_reduce`.**
* **Hint:**
    * `array_map`: Modifies each element and returns an array of the *same length*.
    * `array_filter`: Removes elements if the callback returns false.
    * `array_reduce`: Iterates through the array and returns a *single value* (e.g., a total sum).

**Q14: How do you merge two arrays? (`array_merge` vs `+` operator)**
* **Hint:** `array_merge($a, $b)` overwrites duplicate string keys with the value from `$b`, and re-indexes numeric keys. `$a + $b` keeps the value from `$a` for duplicate keys.

**Q15: How do you check if a key exists in an array? (`array_key_exists` vs `isset`)**
* **Hint:** `isset($arr['key'])` returns false if the key exists but its value is `null`. `array_key_exists('key', $arr)` returns true even if the value is `null`.

**Q16: How do you sort an array by values vs keys?**
* **Hint:** 
    * `sort()` / `rsort()`: Sorts values, destroys original keys.
    * `asort()` / `arsort()`: Sorts values, maintains key association.
    * `ksort()` / `krsort()`: Sorts by keys.

**Q17: How to extract a single column from a multidimensional array?**
* **Hint:** Use `array_column($array, 'column_name')`.

---

## 4. PHP String & Data Functions

**Q18: Difference between `strpos` and `strstr`?**
* **Hint:** `strpos` returns the numerical position (integer) of the first occurrence of a substring. `strstr` returns the portion of the string from the first occurrence to the end. `strpos` is much faster for simple checks.

**Q19: Difference between `implode` and `explode`?**
* **Hint:** `explode(',', $string)` breaks a string into an array based on a delimiter. `implode(',', $array)` joins array elements into a single string.

**Q20: Difference between `substr` and `mb_substr`?**
* **Hint:** `substr` works with standard single-byte characters. If you are dealing with multi-byte characters (like emojis or foreign languages like Japanese), you must use `mb_substr` to avoid breaking the characters.

**Q21: How do you parse a JSON string into an array?**
* **Hint:** `json_decode($jsonString, true)`. If you omit the `true` as the second parameter, it returns an Object instead of an associative array.

**Q22: How do you check if a string contains another string (PHP 8)?**
* **Hint:** Use `str_contains($haystack, $needle)`. In PHP 7, you had to use `strpos($haystack, $needle) !== false`.

---

## 5. Algorithmic Questions (Without Built-In Functions)

**Q23: Reverse a string character by character WITHOUT `strrev()`.**
* **Hint:**
```php
function reverseString($str) {
    $reversed = '';
    $i = 0;
    while (isset($str[$i])) { $i++; } // Find length manually
    for ($j = $i - 1; $j >= 0; $j--) {
        $reversed .= $str[$j];
    }
    return $reversed;
}
```

**Q24: Reverse the *words* in a string WITHOUT `explode()` or `array_reverse()`.**
* **Hint:** (e.g., "Hello World" -> "World Hello")
```php
function reverseWords($str) {
    $result = ''; $word = ''; $i = 0;
    while (isset($str[$i])) {
        if ($str[$i] == ' ') {
            $result = $word . ' ' . $result;
            $word = ''; // Reset
        } else {
            $word .= $str[$i];
        }
        $i++;
    }
    return trim($word . ' ' . $result);
}
```

**Q25: Find the highest value in an array without using `max()`.**
* **Hint:**
```php
function findMax($arr) {
    $highest = $arr[0];
    foreach($arr as $val) {
        if($val > $highest) {
            $highest = $val;
        }
    }
    return $highest;
}
```

---

## 6. Security, Authentication & Rate Limiting

**Q26: What is CSRF and how do you prevent it?**
* **Hint:** Cross-Site Request Forgery is forcing a user's browser to execute unwanted actions on a site they are logged into. Prevented by generating a unique server-side token stored in the session and embedded as a hidden field in forms. On POST, verify they match.

**Q27: How do you protect against SQL Injection?**
* **Hint:** Never concatenate POST data into raw queries. Use Prepared Statements (PDO) or Query Builders, which automatically escape data.

**Q28: What is XSS and how to prevent it?**
* **Hint:** Cross-Site Scripting occurs when an attacker injects malicious JS into a page (e.g., via a comment form). Prevent by escaping all output before rendering it to the browser using `htmlspecialchars()`.

**Q29: How would you implement Rate Limiting for a Login route?**
* **Hint:** Store the user's IP in a database/Redis alongside a timestamp. On request, check if the IP has exceeded 5 requests in 1 minute. If so, return a `429 Too Many Requests` status code.

---

## 7. Database, ORM & CodeIgniter 3 Logic

**Q30: What is an ORM (Object-Relational Mapping)?**
* **Hint:** A programming technique that maps database tables to classes, and rows to objects. It allows developers to interact with the database using object-oriented syntax rather than writing raw SQL query strings.

**Q31: Does CodeIgniter 3 have a true ORM?**
* **Hint:** No. CI3 uses a "Query Builder" pattern (`$this->db->get()`). It simplifies SQL writing but does not map tables to actual Entity classes that understand relationships, unlike true ORMs (like Eloquent or Doctrine).

**Q32: How did you solve the N+1 Query Problem in your CI3 project?**
* **Hint:** The N+1 problem occurs when you query a list of events (1 query) and then run a separate query inside a loop for each event's registrations (N queries). I solved this by writing a single Query Builder `JOIN` combined with `GROUP BY` to fetch events and their registration counts simultaneously.

**Q33: Explain your Event Quota System logic in CI3.**
* **Hint:** On registration, fetch the user's role. Query `event_quotas` for the max limit. Count existing non-rejected `registrations` for that role. If count >= limit, mark as `waitlisted`, else `pending`.

---

## 8. Laravel Architecture & Eloquent ORM

**Q34: What is Eloquent in Laravel?**
* **Hint:** Laravel's built-in ORM based on the Active Record pattern. It allows you to define Models that perfectly map to database tables and natively understand relationships.

**Q35: How do you solve the N+1 Query Problem in Laravel Eloquent?**
* **Hint:** Use Eager Loading with the `with()` method. For example: `Event::with('registrations')->get();`. This fetches all events, and then runs only *one* additional query to fetch all related registrations using a `WHERE IN` clause.

**Q36: Explain the difference between `hasMany` and `belongsTo` relationships.**
* **Hint:** 
    * `hasMany` is used on the parent model (e.g., An `Event` hasMany `Registrations`).
    * `belongsTo` is used on the child model (e.g., A `Registration` belongsTo an `Event`). The child table is the one that contains the foreign key (`event_id`).

**Q37: What are Accessors and Mutators in Laravel?**
* **Hint:** 
    * **Mutators:** Format data *before* it is saved to the database (e.g., automatically hashing a password).
    * **Accessors:** Format data *after* it is retrieved from the database (e.g., converting a raw date string into a human-readable format) without altering the actual DB record.

**Q38: What are Laravel Collections?**
* **Hint:** A powerful object-oriented wrapper around standard PHP arrays. Collections provide dozens of fluent, chainable methods for mapping, filtering, and reducing data (e.g., `$collection->map()->filter()`).

**Q39: What is the difference between Route Middleware and Global Middleware in Laravel?**
* **Hint:** 
    * **Global Middleware:** Runs on *every single* HTTP request hitting the application (e.g., checking maintenance mode, trimming strings).
    * **Route Middleware:** Assigned only to specific routes or route groups (e.g., checking if a user is authenticated using the `auth` middleware).

**Q40: What are Laravel Service Providers?**
* **Hint:** They are the central place of all Laravel application bootstrapping. They bind things into the Service Container (dependency injection) and register events, middleware, and routes before the application handles a request.

**Q41: Explain Soft Deletes in Laravel Eloquent.**
* **Hint:** Instead of physically `DELETE`ing a record from the database, Soft Deletes sets a `deleted_at` timestamp on the row. Subsequent Eloquent queries will automatically hide these models unless you chain the `withTrashed()` method.
