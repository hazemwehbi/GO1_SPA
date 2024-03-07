## Laravel Vue SPA, Auth & CRUD
Using Laravel and Vue.js 3, we are going to create a single page application. We will learn who to create, read, update, delete and auth using Vue 3 and Laravel API backend.

## Learners and Courses
Learners are people using Go1 to learn something. Courses are videos, quizzes, interactive experiences, etc.

For this challenge, the dataset contains a map of LearnerIds and a list of CourseIds that the Learner's have completed.

We'd like to know about courses that have only been completed by a single learner.

Return a list of CourseId's that have only been completed by 1 Learner.

## Example input:

{
  "Learner-0001": [
    "Course-0001",
    "Course-0002",
    "Course-0003"
  ],
  "Learner-0002": [
    "Course-0002",
    "Course-0003",
    "Course-0004"
  ]
}
## Example output:

[ "Course-0001", "Course-0004" ]

