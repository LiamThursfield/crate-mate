# 🤝 Contributing to CrateMate

We welcome and appreciate all contributions to CrateMate! Whether you are fixing a bug, proposing a new feature, or improving documentation, your help is valuable.

## ❓ How to Contribute

There are several ways you can contribute to the project:

1.  **Reporting Bugs:** If you find something broken, open a detailed issue.
2.  **Suggesting Features:** Have an idea? Open an issue to discuss it first.
3.  **Submitting Pull Requests (PRs):** Ready to dive into the code? Follow the workflow below.
4.  **Improving Documentation:** Clarity is key! Help us refine the README, documentation, or codebase comments.

## 🐛 Reporting Bugs

If you encounter a bug, please check the existing issues before creating a new one. When submitting a bug report, include as many details as possible:

* **Steps to Reproduce:** Clear, numbered steps to replicate the issue.
* **Expected Result:** What should have happened.
* **Actual Result:** What actually happened.
* **Environment:** Operating System, Browser, and any specific software versions relevant to the bug.
* **CrateMate Version:** (If applicable) The version/commit hash you are testing.

## ✨ Suggesting Features

We love new ideas! Before starting work on a major new feature, please open an issue to discuss the concept with the maintainers first. This ensures we are aligned on the goal and technical approach, saving you time.

## 💻 Code Contribution Workflow

This project utilizes **Laravel Sail** (Docker) for environment consistency and **pnpm** for frontend dependencies.

### 1. Set Up Your Environment

Follow the detailed instructions in the [README.md](README.md) file under the "Getting Started" section to set up your local development environment using Sail and pnpm.

### 2. Branching

1.  Fork the repository and clone your fork.
2.  Create a new branch for your feature or fix. Use descriptive names:
    * **Features:** `feature/new-feature-name`
    * **Bugs:** `fix/issue-description`
    * **Docs:** `docs/readme-update`

### 3. Making Changes

* **Coding Style:** Adhere to the PSR-12 standard for PHP and the existing component structure for Vue/Inertia.
* **Migration/Database:** If your change requires database schema modifications, run the migrations inside Sail: `./vendor/bin/sail artisan migrate`.
* **Frontend Assets:** Remember to compile assets after making Vue/CSS changes: `./vendor/bin/sail pnpm run dev`.

### 4. Committing

Write clear, concise commit messages. A good commit message explains **what** changed and **why**.

### 5. Submitting Your Pull Request (PR)

1.  Push your branch to your fork.
2.  Open a Pull Request against the `main` branch of the original CrateMate repository.
3.  **PR Description:** Fill out the PR template completely, clearly explaining the purpose of the PR and referencing any related issue number (e.g., `Closes #123`).

## ✅ Code Review and Testing

All contributions are subject to review. We kindly request that you:

* **Test your changes:** Ensure your code works as intended and doesn't introduce regressions.
* **Address feedback:** Be responsive to comments and change requests from maintainers.

Thank you for helping to build CrateMate!
