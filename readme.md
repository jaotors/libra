## Project Libra
[![Build Status](https://travis-ci.org/jmramos02/libra.svg?branch=master)](https://travis-ci.org/jmramos02/libra)

Libra is an open source library system. it includes basic functions like opac, basic returning and borrowing of books, computation for penalties, and many much more.

## Laravel

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## User Roles

### Student
- Borrow and Return
- View books via opac

### Librarian
- Add / Edit of books
- Tell which books are available
- Issue borrow / return books

### Sysad
- Maintenance of users
- Maintenance of books

#### Revision
- List of Damaged Books
- List of Lost Materials
- List of Weeded Books
- System must accomodate repeating copies for one title
  - Note: If a titile has several copies, book information should contain only the number of copies instead of listing the books several times.
- A book title, entered twice has same ISBN, Author but different place of publication
- "TITLE" should be in all module when referring to "BOOK TITLE"
- USER LIST MODULE - # should be ID#
- Have separate module for reserve and borrow
- BOOK CLASSIFICATION: Adding of Books still not working
- Reasons for weeding are hard coded : Lost Materials, Lost Books, Damaged books
- Faculty module/account should reflect if book is already returned or overdue for his clearance for that sem

#### WANTS TO ADD
- notification for overdue books and penalties
- Graphs for important reports
- Homepage
- Announcements